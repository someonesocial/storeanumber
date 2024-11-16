<?php
require_once '../src/config.php';
require_once '../src/Database.php';

// Start session early
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'cookie_samesite' => 'Strict',
    'gc_maxlifetime' => 3600
]);

// CORS headers
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle OPTIONS preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$database = new Database();
$conn = $database->getConnection();

// Parse request path
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = str_replace('/api/', '/', $request_uri);
$request_uri = str_replace('/api', '', $request_uri);

// Log incoming request
error_log("Request URI: " . $request_uri);

switch ($request_uri) {
    case '/login':
        require_once '../src/api/login.php';
        break;
    case '/register':
        require_once '../src/api/register.php';
        break;
    case '/logout':
        require_once '../src/api/logout.php';
        break;
    case '/getNumber':
        require_once '../src/api/getNumber.php';
        break;
    case '/saveNumber':
        require_once '../src/api/saveNumber.php';
        break;
    default:
        error_log("No route found for: " . $request_uri);
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
}
