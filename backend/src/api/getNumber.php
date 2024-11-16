<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/Database.php';

// No need for session_start() as it's already started in index.php
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$database = new Database();
$conn = $database->getConnection();

$userId = $_SESSION['user_id'];
error_log("Fetching number for user ID: $userId");

$stmt = $conn->prepare("SELECT number FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $number = $user['number'];
    error_log("Found number for user: " . ($number === null ? 'null' : $number));
    http_response_code(200);
    echo json_encode(['number' => $number]);
} else {
    error_log("No user found with ID: $userId");
    http_response_code(404);
    echo json_encode(['error' => 'Number not found']);
}
