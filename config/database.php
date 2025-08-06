<?php
class DataBase
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'classtrack';

    public $conn;
    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection to database failed");
        } else {
            $this->conn = $conn;
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
