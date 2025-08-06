<?php
require_once '../config/database.php';
require_once '../models/Feedback.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentName = isset($_POST['studentName']) ? trim($_POST['studentName']) : null;
    $matricNo = trim($_POST['matricNo']);
    $department = trim($_POST['department']);
    $category = $_POST['category'];
    $message = trim($_POST['message']);
    $anonymous = isset($_POST['anonymous']) ? 1 : 0;

    // Basic validation (optional)
    if (empty($matricNo) || empty($department) || empty($category) || empty($message)) {
        die("Please fill in all required fields.");
    }

    $feedbackData = [
        'studentName' => $studentName,
        'matricNo' => $matricNo,
        'department' => $department,
        'category' => $category,
        'message' => $message,
        'anonymous' => $anonymous
    ];

    $database = new Database();
    $db = $database->getConnection();

    $feedback = new Feedback($db);
    $result = $feedback->submitFeedback($feedbackData);

    if ($result) {
        header("Location: ../public/feedback.php");
    } else {
        echo "Error submitting feedback.";
    }
}
