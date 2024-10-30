<?php
header('Content-Type: application/json');

session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$number = $data['number'];
$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("UPDATE users SET number = ? WHERE id = ?");
$stmt->bind_param("ii", $number, $userId);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['message' => 'Number saved successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save number']);
}
