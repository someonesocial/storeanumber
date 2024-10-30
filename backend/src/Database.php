<?php
class Database
{
    private $conn;

    public function __construct()
    {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
        $this->conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
