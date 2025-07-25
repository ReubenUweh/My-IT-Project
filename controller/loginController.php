<?php
session_start();
require_once "../config/database.php";
require_once "../models/student.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new DataBase();
    $conn = $db->conn;

    $lastName = $_POST['lastName'] ?? '';
    $matricNo = $_POST['password'] ?? '';

    // Validating inputs
    if (empty($lastName) || empty($matricNo)) {
        throw new Exception("All fields are required.");
    }

    // Creating a new Student instance
    $student = new Student($conn);
    try {
        // Attempting to login the student
        $result = $student->login($lastName, $matricNo);
        if ($result) {
            $_SESSION['studentId'] = $result['id'];
            header("Location: /public/index.php");
            exit();
        } else {
            $_SESSION['error'] = "Login failed: Invalid last name or matric number.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error:" . $e->getMessage();
    }
    header("Location: /public/login.php");
    exit();
    header("Location: /public/login.php");
}
