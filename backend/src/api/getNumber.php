<?php
header('Content-Type: application/json');

session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT number FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    http_response_code(200);
    echo json_encode(['number' => $user['number']]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Number not found']);
}
