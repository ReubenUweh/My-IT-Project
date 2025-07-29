<?php
require "../../config/database.php";

// Validate and get the faculty ID
$facultyId = isset($_GET['facultyId']) ? intval($_GET['facultyId']) : 0;

if ($facultyId <= 0) {
    echo json_encode([]);
    exit;
}

// Connect to DB
$db = new Database();
$conn = $db->conn;

// Fetch departments
$stmt = $conn->prepare("SELECT id, departmentName FROM departments WHERE facultyId = ?");
$stmt->bind_param("i", $facultyId);
$stmt->execute();
$result = $stmt->get_result();

$departments = [];
while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

// Return as JSON
header('Content-Type: application/json');
echo json_encode($departments);
exit;