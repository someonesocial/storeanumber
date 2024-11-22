<?php
header('Content-Type: application/json');

// Destroy user session
session_start();
session_destroy();

// Return success response
http_response_code(200);
echo json_encode(['message' => 'Logged out successfully']);
