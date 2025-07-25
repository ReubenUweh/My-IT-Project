<?php
session_start();
require_once "../config/database.php";

$db = new DataBase();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facultyName = $_POST['facultyName'];
    $facultyCode = $_POST['facultyCode'];

    // Escaping input to prevent SQL injection
    $facultyName = $conn->real_escape_string($facultyName);
    $facultyCode = $conn->real_escape_string($facultyCode);

    // ✅ Inserting into the faculties table
    $stmt = "INSERT INTO faculties (facultyName, facultyCode)";
    $stmt .= " VALUES ('$facultyName', '$facultyCode')";
    $result = $conn->query($stmt);

    if ($result) {
        $_SESSION['message'] = "Faculty added successfully";
    } else {
        $_SESSION['error'] = "Insert failed: " . $conn->error; 
    }

    header("Location: /admin/adminSetup.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request";
    header("Location: /admin/adminSetup.php");
    exit();
}
?>


