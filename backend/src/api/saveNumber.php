<?php
// Set JSON response header
header('Content-Type: application/json');
// Include required configuration and database files
require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/Database.php';

// Check if user is authenticated via session
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

// Get request body data and extract number
$data = json_decode(file_get_contents("php://input"), true);
$number = $data['number'];
$userId = $_SESSION['user_id'];

// Log the save attempt
error_log("Saving number $number for user ID: $userId");

// Initialize database connection
$database = new Database();
$conn = $database->getConnection();

// 1. Prepare SQL statement with placeholders (?)
$stmt = $conn->prepare("UPDATE users SET number = ? WHERE id = ?");

// 2. Bind parameters securely
$stmt->bind_param("ii", $number, $userId);
// "ii" means: two integer parameters
// $number is bound to first ?, $userId to second ?

// 3. Execute the prepared statement
if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['message' => 'Number saved successfully']);
    error_log("Number saved successfully");
} else {
    error_log("Failed to save number: " . $stmt->error);
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save number']);
}
