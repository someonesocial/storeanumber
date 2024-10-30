<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

// Check if username already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Username already exists']);
    exit;
}

// Hash password and create user
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    $userId = $stmt->insert_id;
    $user = [
        'id' => $userId,
        'username' => $username
    ];

    session_start();
    $_SESSION['user_id'] = $userId;

    http_response_code(201);
    echo json_encode(['user' => $user]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create user']);
}
