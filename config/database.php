<?php
class DataBase
{
    private $host = 'mysql-reuben-uweh.alwaysdata.net';
    private $username = '406264';
    private $password = 'Rairai206';
    private $database = 'reuben-uweh_classtrack';

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
