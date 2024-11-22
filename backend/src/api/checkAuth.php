<?php
header('Content-Type: application/json');

// Check if user session exists
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

// Get user data from database
$database = new Database();
$conn = $database->getConnection();

// Verify user still exists and get their info
$stmt = $conn->prepare("SELECT id, username FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Return user data or error
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $userData = [
        'id' => $user['id'],
        'username' => $user['username']
    ];
    echo json_encode(['user' => $userData]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'User not found']);
}
