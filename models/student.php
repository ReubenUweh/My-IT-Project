<?php
require_once "../config/database.php";

class Student
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($firstName, $lastName, $matricNo, $departmentId)
    {
        $firstName = $this->conn->real_escape_string($firstName);
        $lastName = $this->conn->real_escape_string($lastName);
        $matricNo = $this->conn->real_escape_string($matricNo);
        $departmentId = (int)$departmentId;

        // Check if student already exists
        $stmt = $this->conn->prepare("SELECT id FROM students WHERE matricNo = ?");
        $stmt->bind_param("s", $matricNo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return false; // already exists
        }
        $stmt->close();

        // Proceed to insert
        $query = "INSERT INTO students (firstName, lastName, matricNo, departmentId) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("sssi", $firstName, $lastName, $matricNo, $departmentId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        return true;
    }
    public function login($lastName, $matricNo)
    {
        $lastName = $this->conn->real_escape_string($lastName);
        $matricNo = $this->conn->real_escape_string($matricNo);

        $stmt = $this->conn->prepare("SELECT id FROM students WHERE lastName = ? AND matricNo = ?");
        $stmt->bind_param("ss", $lastName, $matricNo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }

        return false;
    }
}
