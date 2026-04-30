<?php
require_once __DIR__ . '/../includes/auth.php';
$user = require_role('admin');
require_once __DIR__ . '/../includes/header.php';
?>
<section class="role-page glass tilt-card admin-theme">
    <p class="eyebrow">Admin Only</p>
    <h1>Admin Page</h1>
    <p>This page is protected by token authentication and role checking. Only Admin users can access it.</p>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
