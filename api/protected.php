<?php
require_once __DIR__ . '/../includes/token.php';
header('Content-Type: application/json');

$user = validate_token(bearer_token());
if (!$user) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Missing or invalid token']);
    exit;
}

echo json_encode([
    'status' => 'success',
    'message' => 'Token is valid. Protected API accessed.',
    'user' => $user
], JSON_PRETTY_PRINT);
