<?php
require_once '../src/config.php';
require_once '../src/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_URI'] === '/api/login') {
        require_once '../src/api/login.php';
    } elseif ($_SERVER['REQUEST_URI'] === '/api/saveNumber') {
        require_once '../src/api/saveNumber.php';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_SERVER['REQUEST_URI'] === '/api/getNumber') {
        require_once '../src/api/getNumber.php';
    }
}
