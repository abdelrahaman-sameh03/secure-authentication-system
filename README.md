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

