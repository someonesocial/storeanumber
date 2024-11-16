<?php
class Database
{
    private $conn;

    public function __construct()
    {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
        try {
            $this->conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
            if ($this->conn->connect_error) {
                throw new RuntimeException('Database connection failed');
            }
        } catch (Exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw $e;
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
