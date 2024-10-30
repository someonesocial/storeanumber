<?php
$data = json_decode(file_get_contents("php://input"), true);
$number = $data['number'];
$userId = 1; // Assuming authenticated user ID

$stmt = $conn->prepare("UPDATE users SET number = ? WHERE id = ?");
$stmt->bind_param("ii", $number, $userId);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['message' => 'Number saved successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save number']);
}
