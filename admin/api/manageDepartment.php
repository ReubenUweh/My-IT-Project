<?php
header('Content-Type: application/json');
require "../config/database.php";

$db = new DataBase();
$conn = $db->conn;

$departmentId = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if ($departmentId && is_numeric($departmentId)) {
        $stmt = $conn->prepare("DELETE FROM departments WHERE id = ?");
        $stmt->bind_param("i", $departmentId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete department']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid department ID']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>