<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];

        $userData = [
            'id' => $user['id'],
            'username' => $user['username']
        ];

        http_response_code(200);
        echo json_encode(['user' => $userData]);
        exit;
    }
}

http_response_code(401);
echo json_encode(['error' => 'Invalid username or password']);
