<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../src/config.php';
require_once __DIR__ . '/../../src/Database.php';
require_once __DIR__ . '/../../src/MessageHandler.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$database = new Database();
$conn = $database->getConnection();

$userId = $_SESSION['user_id'];
error_log("Fetching number for user ID: $userId");

$stmt = $conn->prepare("SELECT number, username FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $number = $user['number'];

    error_log("Found number for user: " . ($number === null ? 'null' : $number));

    $messageHandler = new MessageHandler($userId, $user['username'], $number);
    $funnyMessage = $messageHandler->getFunnyMessage();

    http_response_code(200);
    echo json_encode([
        'number' => $number,
        'funnyMessage' => $funnyMessage
    ]);
} else {
    error_log("No user found with ID: $userId");
    http_response_code(404);
    echo json_encode(['error' => 'Number not found']);
}
