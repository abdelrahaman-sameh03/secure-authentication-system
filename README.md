# 🔐 Secure Authentication System

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-Local_Server-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![Security](https://img.shields.io/badge/Security-2FA%20%7C%20RBAC%20%7C%20Token-success?style=for-the-badge)

A secure authentication system built with **PHP, MySQL, and XAMPP**.

This project demonstrates core security concepts including **password hashing**, **Two-Factor Authentication (2FA)**, **token-based authentication**, and **Role-Based Access Control (RBAC)**.

---

## 📌 Project Overview

This system allows users to register, log in securely, verify their identity using an authenticator app, and access protected pages based on their assigned role.

The project was developed as part of a **Secure Authentication System assignment** to demonstrate practical implementation of authentication and authorization techniques.

---

## ✨ Features

- User registration with name, email, password, and role
- Secure password hashing using `password_hash()`
- Login verification using `password_verify()`
- Two-Factor Authentication using TOTP
- QR Code setup for authenticator apps
- Token generation after successful login and 2FA verification
- Protected routes using token validation
- Role-Based Access Control with three roles:
  - Admin
  - Manager
  - User
- Unauthorized access blocking
- MySQL database integration using PDO prepared statements
- Clean project structure

---

## 🛡️ Security Concepts Implemented

### 1. Password Hashing

Passwords are never stored as plain text.

During registration, the password is hashed before being saved in the database.

```php
password_hash($password, PASSWORD_DEFAULT);
```

During login, the entered password is verified against the stored hash.

```php
password_verify($password, $user['password_hash']);
```

---

### 2. Two-Factor Authentication 2FA

After registration, the system generates a unique secret key for the user and displays it as a QR Code.

The user scans the QR Code using an authenticator app such as:

- Google Authenticator
- Microsoft Authenticator
- Authy

The authenticator app generates a 6-digit code that changes every 30 seconds.

During login, the user must enter this code to complete authentication.

---

### 3. Token-Based Authentication

After successful password verification and 2FA verification, the system generates a secure token.

The token identifies the authenticated user and is required to access protected routes and API endpoints.

---

### 4. Role-Based Access Control RBAC

The system supports exactly three user roles:

| Role | Permission |
|---|---|
| Admin | Access admin-only page |
| Manager | Access manager-only page |
| User | Access user-only page |

If a user tries to access a page outside their role, the system blocks access.

---

## 🧰 Technologies Used

- PHP
- MySQL
- XAMPP
- HTML
- CSS
- JavaScript
- Google Authenticator / Microsoft Authenticator / Authy

---

## 📂 Project Structure

```text
secure_auth_system
│
├── api
│   ├── protected.php
│   └── role.php
│
├── assets
│   ├── css
│   └── js
│
├── auth
│   ├── register.php
│   ├── setup_2fa.php
│   ├── login.php
│   ├── verify_2fa.php
│   └── logout.php
│
├── config
│   ├── app.php
│   └── database.php
│
├── database
│   └── secure_auth_system.sql
│
├── includes
│   ├── auth.php
│   ├── functions.php
│   ├── token.php
│   └── totp.php
│
├── pages
│   ├── dashboard.php
│   ├── profile.php
│   ├── admin.php
│   ├── manager.php
│   ├── user.php
│   └── blocked.php
│
└── public
    └── index.php
```

---

## 🗄️ Database Setup

1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL**
3. Open **phpMyAdmin**
4. Import the SQL file:

```text
database/secure_auth_system.sql
```

The database contains a `users` table with:

- id
- name
- email
- password_hash
- role
- twofa_secret
- created_at

---

## 🚀 How to Run the Project

1. Move the project folder to:

```text
C:\xampp\htdocs\
```

2. Start Apache and MySQL from XAMPP.

3. Open the project in your browser:

```text
http://localhost/secure_auth_system/public/index.php
```

---

## 🧪 Demo Flow

1. Register a new user.
2. Select a role: Admin, Manager, or User.
3. Scan the QR Code using an authenticator app.
4. Log in using email and password.
5. Enter the 6-digit 2FA code from the authenticator app.
6. After successful verification, a token is generated.
7. Access the dashboard.
8. Test protected pages:
   - Admin page
   - Manager page
   - User page
9. Try accessing a page with the wrong role to confirm RBAC protection.

---

## 🔐 Protected Pages

| Page | Protection |
|---|---|
| Dashboard | Requires valid token |
| Profile | Requires valid token |
| Admin Page | Requires Admin role |
| Manager Page | Requires Manager role |
| User Page | Requires User role |

---

## 🌐 API Endpoints

### Protected API

```text
/api/protected.php
```

Requires a valid token.

### Role-Based API

```text
/api/role.php?role=admin
/api/role.php?role=manager
/api/role.php?role=user
```

Requires a valid token and matching role.


---

## 👨‍💻 Author

**Abdelrahman Sameh**

GitHub: [abdelrahaman-sameh03](https://github.com/abdelrahaman-sameh03)

---

## 📌 Notes

This project is designed for educational purposes and runs locally using XAMPP.
