<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/Database.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$number = $data['number'];
$userId = $_SESSION['user_id'];

error_log("Saving number $number for user ID: $userId");

$database = new Database();
$conn = $database->getConnection();

$stmt = $conn->prepare("UPDATE users SET number = ? WHERE id = ?");
$stmt->bind_param("ii", $number, $userId);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['message' => 'Number saved successfully']);
    error_log("Number saved successfully");
} else {
    error_log("Failed to save number: " . $stmt->error);
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save number']);
}
