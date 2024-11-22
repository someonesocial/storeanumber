<?php
class Database
{
    private $conn; // Stores database connection

    public function __construct()
    {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
        try {
            // Create MySQL connection with environment variables
            $this->conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
            if ($this->conn->connect_error) {
                throw new RuntimeException('Database connection failed');
            }
        } catch (Exception $e) {
            // Log and rethrow any connection errors
            error_log("Database connection error: " . $e->getMessage());
            throw $e;
        }
    }

    // Return the database connection for queries
    public function getConnection()
    {
        return $this->conn;
    }
}
