<?php
header('Content-Type: application/json');
require "../config/database.php";

$db = new DataBase();
$conn = $db->conn;

$method = $_SERVER['REQUEST_METHOD'];
$facultyId = $_GET['id'] ?? null;

switch ($method) {
    case 'GET':
        if ($facultyId) {
            $stmt = $conn->prepare("SELECT * FROM faculties WHERE id = ?");
            $stmt->bind_param("i", $facultyId);
            $stmt->execute();
            $result = $stmt->get_result();
            echo json_encode($result->fetch_assoc());
        }
        break;
        
    case 'DELETE':
        if ($facultyId) {
            // First delete associated departments
            // $conn->query("DELETE FROM departments WHERE faculty_id = $facultyId");
            
            // Then delete faculty
            $result = $conn->query("DELETE FROM faculties WHERE id = $facultyId");
            echo json_encode(['success' => $result]);
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
?>
