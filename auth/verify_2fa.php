<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/totp.php';
require_once __DIR__ . '/../includes/token.php';
require_once __DIR__ . '/../includes/functions.php';

$userId = $_SESSION['pending_2fa_user_id'] ?? null;
if (!$userId) {
    set_flash('danger', 'Please login with email and password first.');
    redirect_to('/auth/login.php');
}

$stmt = $pdo->prepare('SELECT id, name, email, role, twofa_secret FROM users WHERE id = ?');
$stmt->execute([$userId]);
$loginUser = $stmt->fetch();
if (!$loginUser) {
    set_flash('danger', 'User not found.');
    redirect_to('/auth/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'] ?? '';
    if (verify_totp($loginUser['twofa_secret'], $code)) {
        $_SESSION['token'] = generate_token($loginUser);
        unset($_SESSION['pending_2fa_user_id']);
        set_flash('success', 'Login successful. Token generated.');
        redirect_to('/pages/dashboard.php');
    }
    set_flash('danger', 'Invalid 2FA code. Try again.');
    redirect_to('/auth/verify_2fa.php');
}

require_once __DIR__ . '/../includes/header.php';
?>
<section class="auth-panel glass tilt-card">
    <div class="form-copy">
        <p class="eyebrow">Step 4</p>
        <h1>2FA Verification</h1>
        <p>Open your authenticator app and enter the current 6-digit code.</p>
    </div>
    <form method="POST" class="form-card">
        <label>6-digit code<input type="text" name="code" pattern="[0-9]{6}" maxlength="6" inputmode="numeric" required></label>
        <button class="btn" type="submit">Verify & Generate Token</button>
    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
