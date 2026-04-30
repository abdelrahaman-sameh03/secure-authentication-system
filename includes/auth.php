<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/token.php';

function current_user(): ?array {
    return validate_token($_SESSION['token'] ?? null);
}

function require_auth(): array {
    $user = current_user();
    if (!$user) {
        set_flash('danger', 'Please login first. A valid token is required.');
        redirect_to('/auth/login.php');
    }
    return $user;
}

function require_role(string|array $roles): array {
    $user = require_auth();
    $allowed = is_array($roles) ? $roles : [$roles];
    if (!in_array($user['role'], $allowed, true)) {
        http_response_code(403);
        include __DIR__ . '/../pages/blocked.php';
        exit;
    }
    return $user;
}

function logout(): void {
    $_SESSION = [];
    session_destroy();
}
