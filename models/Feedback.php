<?php
class Feedback
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function submitFeedback($data)
    {
        $query = "INSERT INTO feedbacks (studentName, matricNo, department, category, message, anonymous) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "sssssi",
            $data['studentName'],
            $data['matricNo'],
            $data['department'],
            $data['category'],
            $data['message'],
            $data['anonymous']
        );

        return $stmt->execute();
    }
}
