<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/totp.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    $allowedRoles = ['admin', 'manager', 'user'];

    if ($name === '' || $email === '' || $password === '' || !in_array($role, $allowedRoles, true)) {
        set_flash('danger', 'All fields are required and role must be valid.');
        redirect_to('/auth/register.php');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash('danger', 'Please enter a valid email address.');
        redirect_to('/auth/register.php');
    }

    if (strlen($password) < 8) {
        set_flash('danger', 'Password must be at least 8 characters.');
        redirect_to('/auth/register.php');
    }

    $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $check->execute([$email]);
    if ($check->fetch()) {
        set_flash('danger', 'Email already exists. Please login.');
        redirect_to('/auth/login.php');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $secret = generate_2fa_secret();

    $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role, twofa_secret) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$name, $email, $passwordHash, $role, $secret]);

    $_SESSION['setup_user_id'] = (int)$pdo->lastInsertId();
    redirect_to('/auth/setup_2fa.php');
}

require_once __DIR__ . '/../includes/header.php';
?>
<section class="auth-panel glass tilt-card">
    <div class="form-copy">
        <p class="eyebrow">Step 1</p>
        <h1>Register</h1>
        <p>Create your account. Your password will be hashed before saving in MySQL.</p>
    </div>
    <form method="POST" class="form-card">
        <label>Name<input type="text" name="name" required></label>
        <label>Email<input type="email" name="email" required></label>
        <label>Password<input type="password" name="password" minlength="8" required></label>
        <label>Role
            <select name="role" required>
                <option value="">Choose role</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="user">User</option>
            </select>
        </label>
        <button class="btn" type="submit">Register & Generate 2FA</button>
    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
