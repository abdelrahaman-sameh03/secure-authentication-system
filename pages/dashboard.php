<?php
require_once __DIR__ . '/../includes/auth.php';
$user = require_auth();
require_once __DIR__ . '/../includes/header.php';
?>
<section class="dashboard glass tilt-card">
    <p class="eyebrow">Protected Route</p>
    <h1>Dashboard</h1>
    <p>Welcome, <strong><?= e($user['name']) ?></strong>. Your role is <strong><?= e(role_label($user['role'])) ?></strong>.</p>
    <div class="token-box">
        <h3>Generated Token</h3>
        <textarea readonly><?= e($_SESSION['token']) ?></textarea>
        <button class="btn ghost" onclick="copyToken()">Copy Token</button>
    </div>
    <div class="cards-grid small">
        <a class="card glass" href="<?= APP_BASE ?>/pages/admin.php"><h3>Admin Page</h3><p>Requires Admin role.</p></a>
        <a class="card glass" href="<?= APP_BASE ?>/pages/manager.php"><h3>Manager Page</h3><p>Requires Manager role.</p></a>
        <a class="card glass" href="<?= APP_BASE ?>/pages/user.php"><h3>User Page</h3><p>Requires User role.</p></a>
        <a class="card glass" href="<?= APP_BASE ?>/pages/profile.php"><h3>Profile Page</h3><p>Requires valid token.</p></a>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
