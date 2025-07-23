<?php
// class Student
// {
//   private $conn;

//   public function __construct($dbConn)
//   {
//     $this->conn = $dbConn;
//   }

//   public function register($data)
//   {
//     $matricNo = $this->sanitize($data['matricNo']);
//     $surname = $this->sanitize($data['surname']);
//     $firstName = $this->sanitize($data['firstName']);
//     $facultyId = intval($data['facultyId']);
//     $departmentId = intval($data['departmentId']);

//     // Check if matricNo already exists
//     $check = $this->conn->prepare("SELECT id FROM students WHERE matricNo = ?");
//     $check->bind_param("s", $matricNo);
//     $check->execute();
//     $check->store_result();

//     if ($check->num_rows > 0) {
//       return ['status' => false, 'message' => 'Matric Number already registered.'];
//     }

//     // Insert into DB
//     $stmt = $this->conn->prepare("INSERT INTO students (matricNo, surname, firstName, facultyId, departmentId) VALUES (?, ?, ?, ?, ?)");
//     $stmt->bind_param("sssii", $matricNo, $surname, $firstName, $facultyId, $departmentId);

//     if ($stmt->execute()) {
//       return ['status' => true, 'message' => 'Student registered successfully!'];
//     } else {
//       return ['status' => false, 'message' => 'Registration failed: ' . $this->conn->error];
//     }
//   }

//   private function sanitize($input)
//   {
//     return htmlspecialchars(trim($input));
//   }
// }
