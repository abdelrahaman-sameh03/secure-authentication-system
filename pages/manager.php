<?php
require_once __DIR__ . '/../includes/auth.php';
$user = require_role('manager');
require_once __DIR__ . '/../includes/header.php';
?>
<section class="role-page glass tilt-card manager-theme">
    <p class="eyebrow">Manager Only</p>
    <h1>Manager Page</h1>
    <p>This route rejects all users except users with the Manager role.</p>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
