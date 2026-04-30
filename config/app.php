<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
 | Auto-detect project URL for XAMPP.
 | This works even if the project folder is nested, for example:
 | /secure_auth_system_xampp_project/secure_auth_system/public/index.php
 */
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$basePath = preg_replace('#/(public|auth|pages|api)(/.*)?$#', '', $scriptName);
$basePath = rtrim($basePath, '/');

if ($basePath === '') {
    $basePath = '/secure_auth_system';
}

define('APP_NAME', 'SecureAuth 3D');
define('APP_BASE', $basePath);
define('TOKEN_SECRET', 'CHANGE_THIS_SECRET_KEY_BEFORE_PRODUCTION_2026');
define('TOKEN_EXPIRY_SECONDS', 3600);
define('ISSUER', 'SecureAuth3D-XAMPP');
