<?php
require_once __DIR__ . '/../includes/token.php';
header('Content-Type: application/json');

$requiredRole = $_GET['role'] ?? '';
$allowed = ['admin', 'manager', 'user'];
if (!in_array($requiredRole, $allowed, true)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Use ?role=admin, ?role=manager, or ?role=user']);
    exit;
}

$user = validate_token(bearer_token());
if (!$user) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Missing or invalid token']);
    exit;
}

if ($user['role'] !== $requiredRole) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Access blocked because role is not allowed']);
    exit;
}

echo json_encode([
    'status' => 'success',
    'message' => 'Role access granted',
    'required_role' => $requiredRole,
    'user_role' => $user['role']
], JSON_PRETTY_PRINT);
