<?php
require_once __DIR__ . '/auth.php';
$flash = get_flash();
$user = current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/style.css">
</head>
<body>
<div class="scene-bg"><span></span><span></span><span></span><span></span></div>
<nav class="nav glass">
    <a class="brand" href="<?= APP_BASE ?>/public/index.php">SecureAuth<span>3D</span></a>
    <div class="nav-links">
        <?php if ($user): ?>
            <a href="<?= APP_BASE ?>/pages/dashboard.php">Dashboard</a>
            <a href="<?= APP_BASE ?>/pages/profile.php">Profile</a>
            <a href="<?= APP_BASE ?>/pages/admin.php">Admin</a>
            <a href="<?= APP_BASE ?>/pages/manager.php">Manager</a>
            <a href="<?= APP_BASE ?>/pages/user.php">User</a>
            <a class="btn tiny" href="<?= APP_BASE ?>/auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="<?= APP_BASE ?>/auth/register.php">Register</a>
            <a class="btn tiny" href="<?= APP_BASE ?>/auth/login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>
<main class="container">
<?php if ($flash): ?>
    <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
<?php endif; ?>
