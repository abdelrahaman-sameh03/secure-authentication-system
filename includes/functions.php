<?php
require_once __DIR__ . '/../config/app.php';

function redirect_to(string $path): void {
    header('Location: ' . APP_BASE . $path);
    exit;
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function set_flash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array {
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function role_label(string $role): string {
    return ucfirst($role);
}
