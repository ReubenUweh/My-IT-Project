<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $course = $_POST['course'];
    $assignmentTitle = $_POST['assignmentTitle'];
    $file = $_FILES['fileUpload'];

    // Step 1: Validate inputs
    if (empty($faculty) || empty($department) || empty($course) || empty($assignmentTitle)) {
        die("All fields are required.");
    }

    // Step 2: Check if file is selected
    if ($file['name'] === '') {
        die("No file selected.");
    }

    // Step 3: Check file type
    $fileType = $file['type'];
    $allowedFormats = [
        'application/pdf',
        'application/vnd.ms-powerpoint',
        'text/csv',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
        'application/msword',
    ];

    if (!in_array($fileType, $allowedFormats)) {
        die("Invalid file type.");
    }

    // Step 4: Check file size (limit: 2MB)
    if ($file['size'] > 2 * 1024 * 1024) {
        die("File size exceeds 2MB.");
    }

    // Step 5: Check for upload error
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading file: " . $file['error']);
    }

    // Step 6: Rename file
    $newFileName = time();

    // Step 7: Set upload directory
    $fileUploadDir = "uploads/$newFileName";
    $fileType = explode('/', $file['type']);
    $fileLocation = "uploads/$newFileName." . $fileType[1];

    // Step 8: Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $fileLocation)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        die("Failed to move uploaded file.");
    }
}
?>
