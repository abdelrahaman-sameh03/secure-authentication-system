<?php require_once __DIR__ . '/../includes/header.php'; ?>
<section class="blocked glass tilt-card">
    <p class="eyebrow">403 Unauthorized</p>
    <h1>Access Blocked</h1>
    <p>Your token is valid, but your role does not have permission to open this page.</p>
    <a class="btn" href="<?= APP_BASE ?>/pages/dashboard.php">Back to Dashboard</a>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
