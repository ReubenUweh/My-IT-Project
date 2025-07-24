<?php
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
        // Attempt to login the student
        $result = $student->login($lastName, $matricNo);
        if ($result) {
            session_start();
            $_SESSION['student_id'] = $result['id'];
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
    $_SESSION['firstName'] = $student['firstName']; // ✅ This must match the DB column key
    $_SESSION['lastName'] = $student['lastName'];
    $_SESSION['matricNo'] = $student['matricNo'];
    header("Location: /public/login.php");
}
