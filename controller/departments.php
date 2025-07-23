<?php
session_start();
require_once "../config/database.php";

$db = new DataBase;
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ✅ Validate and sanitize input
    $departmentName = $conn->real_escape_string($_POST['departmentName']);
    $departmentCode = $conn->real_escape_string($_POST['departmentCode']);
    $facultyId = $conn->real_escape_string($_POST['facultyId'] ?? null); 

    // ✅ Insert into the departments table
    $stmt = "INSERT INTO departments (departmentName, departmentCode, facultyId)";
    $stmt .= " VALUES ('$departmentName', '$departmentCode', '$facultyId')";

    $result = $conn->query($stmt);

    if ($result) {
        $_SESSION['message'] = "Department added successfully";
        header("Location: ../adminSetup.php");
        exit();
    } else {
        $_SESSION['error'] = "Insert failed: " . $conn->error; 
        header("Location: ../adminSetup.php");
        exit();
    }

} else {
    $_SESSION['message'] = "Unable to process data";
    header("Location: ../adminSetup.php");
    exit();
}
