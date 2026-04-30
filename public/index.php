<?php require_once __DIR__ . '/../includes/header.php'; ?>
<section class="hero glass tilt-card">
    <div>
        <p class="eyebrow">Data Integrity & Authentication</p>
        <h1>Secure Authentication System</h1>
        <p class="lead">A complete XAMPP-ready PHP/MySQL authentication website with password hashing, real 2FA, token-based authentication, protected routes, and role-based access control.</p>
        <div class="actions">
            <a class="btn" href="<?= APP_BASE ?>/auth/register.php">Create Account</a>
            <a class="btn ghost" href="<?= APP_BASE ?>/auth/login.php">Login</a>
        </div>
    </div>
    <div class="cube-wrap" aria-hidden="true">
        <div class="cube">
            <div>AUTH</div><div>2FA</div><div>JWT</div><div>RBAC</div><div>HASH</div><div>SQL</div>
        </div>
    </div>
</section>
<section class="cards-grid">
    <article class="card glass"><h3>Password Hashing</h3><p>Passwords are stored only as secure hashes using PHP password_hash.</p></article>
    <article class="card glass"><h3>Authenticator 2FA</h3><p>Each user gets a unique TOTP secret and scannable QR code.</p></article>
    <article class="card glass"><h3>Token Protection</h3><p>A signed token is required before accessing sensitive pages and APIs.</p></article>
    <article class="card glass"><h3>RBAC</h3><p>Exactly three roles are implemented: Admin, Manager, and User.</p></article>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
