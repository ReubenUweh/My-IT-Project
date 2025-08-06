<?php
session_start();
require '../config/database.php';

if (!isset($_SESSION['studentId'])) {
    die("Unauthorized access.");
}

$studentId = $_SESSION['studentId'];
$title = $_POST['title'] ?? '';
$assignmentId = $_POST['assignmentId'] ?? null;
$file = $_FILES['fileUpload'] ?? null;

if (empty($title) || empty($assignmentId) || empty($file['name'])) {
    die("Missing required fields.");
}

$allowedTypes = [
    'application/pdf',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
];

$maxSize = 5 * 1024 * 1024;

if (!in_array($file['type'], $allowedTypes)) {
    die("Invalid file type.");
}

if ($file['size'] > $maxSize) {
    die("File size exceeds 5MB.");
}

$fileContent = file_get_contents($file['tmp_name']);
$fileName = preg_replace("/[^A-Za-z0-9_\-\.]/", '_', basename($file['name']));
$createTime = date('Y-m-d H:i:s');
$null = null;

$db = new DataBase();
$conn = $db->conn;

$stmt = $conn->prepare("INSERT INTO submissions 
    (create_time, title, uploadFile, assignmentId, fileName, studentId, status)
    VALUES (?, ?, ?, ?, ?, ?, 'submitted')
    ON DUPLICATE KEY UPDATE 
        uploadFile = VALUES(uploadFile), 
        fileName = VALUES(fileName), 
        status = 'submitted', 
        create_time = VALUES(create_time)");

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param('sssisi', $createTime, $title, $fileContent, $assignmentId, $fileName, $studentId);
$stmt->send_long_data(2, $fileContent);

if ($stmt->execute()) {
    header("Location: ../public/submissions.php?assignmentId=" . $assignmentId);
    exit;
} else {
    die("Upload failed: " . $stmt->error);
}
