<?php
class student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

  public function registerStudent($data) {
    $firstName = $this->conn->real_escape_string($data['firstName']);
    $lastName = $this->conn->real_escape_string($data['lastName']);
    $matricNumber = $this->conn->real_escape_string($data['matricNumber']);
    $departmentId = $this->conn->real_escape_string($data['departmentId']);

    //checking if matric number already exists
    $checkQuery = "SELECT * FROM students WHERE matricNumber = '$matricNumber'";
    $result = $this->conn->query($checkQuery);
    if ($result->num_rows > 0) {
        return false; // Matric number already exists
    }

    // Prepare the SQL statement
    $stmt = $this->conn->prepare();
  }
}
?>