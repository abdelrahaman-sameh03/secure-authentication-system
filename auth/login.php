<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $loginUser = $stmt->fetch();

    if (!$loginUser || !password_verify($password, $loginUser['password_hash'])) {
        set_flash('danger', 'Invalid email or password.');
        redirect_to('/auth/login.php');
    }

    $_SESSION['pending_2fa_user_id'] = (int)$loginUser['id'];
    redirect_to('/auth/verify_2fa.php');
}

require_once __DIR__ . '/../includes/header.php';
?>
<section class="auth-panel glass tilt-card">
    <div class="form-copy">
        <p class="eyebrow">Step 3</p>
        <h1>Login</h1>
        <p>Enter email and password first. If correct, you will continue to 2FA verification.</p>
    </div>
    <form method="POST" class="form-card">
        <label>Email<input type="email" name="email" required></label>
        <label>Password<input type="password" name="password" required></label>
        <button class="btn" type="submit">Login & Verify 2FA</button>
    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
