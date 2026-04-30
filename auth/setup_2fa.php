<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/totp.php';
require_once __DIR__ . '/../includes/functions.php';

$userId = $_SESSION['setup_user_id'] ?? null;
if (!$userId) {
    set_flash('danger', 'Please register first.');
    redirect_to('/auth/register.php');
}

$stmt = $pdo->prepare('SELECT id, name, email, twofa_secret FROM users WHERE id = ?');
$stmt->execute([$userId]);
$setupUser = $stmt->fetch();
if (!$setupUser) {
    set_flash('danger', 'User not found.');
    redirect_to('/auth/register.php');
}

$uri = provisioning_uri($setupUser['email'], $setupUser['twofa_secret']);
$qr = qr_url($uri);

require_once __DIR__ . '/../includes/header.php';
?>
<section class="auth-panel glass tilt-card">
    <div class="form-copy">
        <p class="eyebrow">Step 2</p>
        <h1>Setup 2FA</h1>
        <p>Scan this QR code using Google Authenticator, Microsoft Authenticator, or Authy.</p>
    </div>
    <div class="qr-card">
        <img class="qr" src="<?= e($qr) ?>" alt="2FA QR Code">
        <p><strong>Manual secret:</strong></p>
        <code><?= e($setupUser['twofa_secret']) ?></code>
        <a class="btn full" href="<?= APP_BASE ?>/auth/login.php">Continue to Login</a>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
