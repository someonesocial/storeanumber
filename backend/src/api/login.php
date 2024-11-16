<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../src/config.php';  // Fix path using __DIR__
require_once __DIR__ . '/../../src/Database.php';

$database = new Database();
$conn = $database->getConnection();

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// Log received data
error_log("Login attempt: Username: $username");

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password are required']);
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // No need to start session here as it's already started in index.php
        $_SESSION['user_id'] = $user['id'];

        $userData = [
            'id' => $user['id'],
            'username' => $user['username']
        ];

        http_response_code(200);
        echo json_encode(['user' => $userData]);

        // Log successful login
        error_log("Login successful: Username: $username");
        exit;
    }
}

http_response_code(401);
echo json_encode(['error' => 'Invalid username or password']);
