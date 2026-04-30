<?php
require_once __DIR__ . '/../includes/auth.php';
$user = require_role('user');
require_once __DIR__ . '/../includes/header.php';
?>
<section class="role-page glass tilt-card user-theme">
    <p class="eyebrow">User Only</p>
    <h1>User Page</h1>
    <p>This page is accessible only when the generated token belongs to a User role account.</p>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
