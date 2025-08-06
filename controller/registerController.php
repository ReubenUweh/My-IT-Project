<?php
session_start();
require "../config/database.php";
require "../models/Student.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new DataBase();
    $conn = $db->conn;

    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $matricNo = $_POST['matricNo'] ?? '';
    $departmentId = $_POST['departmentId'] ?? '';

    // Validating inputs
    if (empty($firstName) || empty($lastName) || empty($matricNo) || empty($departmentId)) {
        throw new Exception("All fields are required.");
    }
    // Creating a new Student instance
    $student = new Student($conn);
    try {
        // Attempting to register the student
        if ($student->register($firstName, $lastName, $matricNo, $departmentId)) {
            $_SESSION['success'] = "Registration successful!";
        } else {
            $_SESSION['error'] = "Registration failed: Student with this matric number already exists.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error:" . $e->getMessage();
    }
    header("Location: /public/login.php");
    exit();
} else {
    header("Location: /public/register.php");
}
