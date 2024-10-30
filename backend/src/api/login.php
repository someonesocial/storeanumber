<?php
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

// Validate and authenticate the user
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // Login successful, return user data
        http_response_code(200);
        echo json_encode(['user' => $user]);
        return;
    }
}

// Login failed
http_response_code(401);
echo json_encode(['error' => 'Invalid username or password']);
