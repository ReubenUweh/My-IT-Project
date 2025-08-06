<?php
require "../config/database.php";

$db = new DataBase();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['assignmentTitle'];
    $assignmentDescription = $_POST['assignmentDescription'];
    $departmentId = $_POST['departmentId'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $allowedFileTypes = isset($_POST['allowedFileTypes']) ? implode(',', $_POST['allowedFileTypes']) : '';

    // File validation
    $file = $_FILES['fileUpload'];
    $maxsize = 3 * 1024 * 1024; // 3MB
    $allowedFileExtension = ['docx', 'pdf', 'txt', 'ppt'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Failed to upload file. Error: " . $file['error']);
    }

    if ($file['size'] > $maxsize) {
        die("File must not exceed 3MB.");
    }

    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedFileExtension)) {
        die("Invalid file type: " . $fileExt);
    }

    $fileData = file_get_contents($file['tmp_name']);
    if ($fileData === false) {
        die("Failed to read file data.");
    }

    $now = date("Y-m-d H:i:s");

    // ✅ Use prepared statements properly
    $stmt = $conn->prepare("INSERT INTO assignments (
        create_time, assignmentTitle, assignmentDescription, departmentId, startDate, endDate, allowedFileTypes, fileNames
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssissss",
        $now,
        $title,
        $assignmentDescription,
        $departmentId,
        $startDate,
        $endDate,
        $allowedFileTypes,
        $fileData
    );

    if ($stmt->execute()) {
        header("Location: ../admin/adminAssignment.php");
    } else {
        echo "Error saving to database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
