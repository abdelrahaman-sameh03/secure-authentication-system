# Secure Authentication System - XAMPP/PHP/MySQL

A complete secure authentication project for **Assignment #2 Secure Authentication System**.

## Features
- User registration with name, email, password, and role
- Password hashing using PHP `password_hash()`
- Login using email + password
- Real TOTP 2FA compatible with Google Authenticator, Microsoft Authenticator, and Authy
- QR code setup page after registration
- JWT-like HMAC token generated after password + 2FA success
- Token-protected routes
- Role-Based Access Control with exactly 3 roles: Admin, Manager, User
- Protected pages: Dashboard, Profile, Admin, Manager, User
- API protected routes using Authorization Bearer token
- 3D animated responsive UI with CSS only
- Clean modular project structure

## Requirements
- XAMPP with Apache and MySQL
- PHP 8.x recommended
- MySQL/MariaDB
- Authenticator app on your phone

## Installation
1. Copy the folder `secure_auth_system` into:
   `C:\xampp\htdocs\`

2. Start **Apache** and **MySQL** from XAMPP Control Panel.

3. Open phpMyAdmin:
   `http://localhost/phpmyadmin`

4. Create/import the database using:
   `database/secure_auth_system.sql`

5. Open the project:
   `http://localhost/secure_auth_system/public/index.php`

## Demo Flow
1. Register a new user.
2. Scan the QR code using Google Authenticator / Microsoft Authenticator / Authy.
3. Check phpMyAdmin and confirm password is hashed.
4. Login with email and password.
5. Enter the 6-digit 2FA code.
6. Dashboard displays the generated token.
7. Try role pages:
   - Admin only: `/pages/admin.php`
   - Manager only: `/pages/manager.php`
   - User only: `/pages/user.php`
8. Unauthorized role access is blocked.

## GitHub Submission Commands
Run these commands inside the project folder:

```bash
git init
git add .
git commit -m "Initial secure authentication system structure"
git commit --allow-empty -m "Add registration with password hashing and 2FA setup"
git commit --allow-empty -m "Add login 2FA verification and token authentication"
git commit --allow-empty -m "Add RBAC protected pages and final UI polish"
git branch -M main
git remote add origin YOUR_GITHUB_REPOSITORY_URL
git push -u origin main
```

Replace `YOUR_GITHUB_REPOSITORY_URL` with your real GitHub repository link.
