<?php
require_once __DIR__ . '/../includes/auth.php';
$user = require_auth();
require_once __DIR__ . '/../includes/header.php';
?>
<section class="dashboard glass tilt-card">
    <p class="eyebrow">Authenticated Profile</p>
    <h1>Profile Page</h1>
    <div class="info-grid">
        <p><span>Name</span><?= e($user['name']) ?></p>
        <p><span>Email</span><?= e($user['email']) ?></p>
        <p><span>Role</span><?= e(role_label($user['role'])) ?></p>
        <p><span>Token Status</span>Valid</p>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
