<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Initialize environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Get database connection settings from environment
$DB_HOST = getenv('DB_HOST');
$DB_USER = getenv('DB_USER');
$DB_PASSWORD = getenv('DB_PASSWORD');
$DB_NAME = getenv('DB_NAME');

// Validate required environment variables exist
$required_vars = ['DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME'];
foreach ($required_vars as $var) {
    if (empty(getenv($var))) {
        throw new RuntimeException("Missing required environment variable: $var");
    }
}
