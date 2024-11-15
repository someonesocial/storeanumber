docker-compose up --build<?php
                            require_once '../src/config.php';
                            require_once '../src/Database.php';

                            // CORS headers
                            header('Access-Control-Allow-Origin: http://localhost:8080');
                            header('Access-Control-Allow-Credentials: true');
                            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
                            header('Access-Control-Allow-Headers: Content-Type');

                            $database = new Database();
                            $conn = $database->getConnection();

                            if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
                                http_response_code(200);
                                exit;
                            }

                            session_start();

                            $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

                            switch ($request_uri) {
                                case '/api/login':
                                    require_once '../src/api/login.php';
                                    break;
                                case '/api/register':
                                    require_once '../src/api/register.php';
                                    break;
                                case '/api/logout':
                                    require_once '../src/api/logout.php';
                                    break;
                                case '/api/getNumber':
                                    require_once '../src/api/getNumber.php';
                                    break;
                                case '/api/saveNumber':
                                    require_once '../src/api/saveNumber.php';
                                    break;
                                default:
                                    http_response_code(404);
                                    echo json_encode(['error' => 'Not found']);
                            }
