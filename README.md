# 🛠️ CivicTrack — Complaint Management System

A PHP-based web application that allows users to register, submit complaints, and track their status. Admins can review, approve, or manage all submitted complaints through a dedicated dashboard.

---

## 📌 Suggested Project Name

**CivicTrack** — *Track every complaint, resolve every issue.*

Alternative names:
- **ComplainHub**
- **VoiceIt** — User-first complaint portal
- **ResolveDesk** — Complaint & resolution tracker

---

## 🖥️ Project Output / Screenshots Overview

| Page | Description |
|------|-------------|
| **Register Page** | New users register with username & password |
| **Login Page** | Secure login with role-based redirect (admin/user) |
| **User Dashboard** | Users can submit new complaints with subject, type, detail & image |
| **Admin Dashboard** | Admins see all complaints in a table with approve/delete actions |
| **Complaint Status** | Each complaint shows: Pending / Approved / Disapproved |

---

## 🚀 Features

- **User Registration & Login** with role-based access control (Admin / User)
- **Complaint Submission** — users can submit complaints with:
  - Subject
  - Complaint Type
  - Detailed description
  - File/Image attachment
- **Admin Dashboard** — view all complaints, approve or reject them
- **Complaint Status Tracking** — users can see if their complaint is pending, approved, or disapproved
- **Session Management** — secure PHP sessions to protect routes
- **Prepared Statements** — SQL injection prevention using `mysqli` prepared statements

---

## 🏗️ Project Structure

```
Complaint-system/
├── index.php                  # Registration page
├── login.php                  # Login page (user & admin)
├── complaint.php              # Handles complaint form submission
├── dashboard.php              # Admin dashboard — view all complaints
├── dashboard (1).php          # Extended admin view
├── approve_complaint.php      # Approve/disapprove a complaint
├── delete.php                 # Delete a complaint
├── pract.php                  # Practice/alternate admin complaints view
├── script.js                  # JS utilities
├── style.css                  # General styles
├── admin.css                  # Admin panel styles
├── user.css                   # User-facing styles
├── user_dashboard.css         # User dashboard styles
├── includes/
│   ├── connection.php         # MySQL DB connection (not in zip)
│   └── base_urls.php          # Base URL constants
└── uploads/                   # Uploaded complaint images/files
```

---

## ⚙️ Installation & Setup

### Requirements
- PHP 7.4+
- MySQL / MariaDB
- Apache/Nginx (XAMPP or WAMP recommended for local dev)

### Steps

1. **Clone or extract** the project into your web server's root directory (e.g., `htdocs/` for XAMPP).

2. **Create the database** — Run the following SQL to set up the required tables:

```sql
CREATE DATABASE complaint_system;
USE complaint_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    subject VARCHAR(255),
    type VARCHAR(100),
    detail TEXT,
    file VARCHAR(255),
    status VARCHAR(50) DEFAULT 'pending'
);
```

3. **Configure database connection** — Create `includes/connection.php`:

```php
<?php
$conn = new mysqli("localhost", "root", "", "complaint_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

4. **Configure base URLs** — Create `includes/base_urls.php`:

```php
<?php
define('BASE_URL_ADMIN', 'http://localhost/Complaint-system/admin/');
define('BASE_URL_USER',  'http://localhost/Complaint-system/user/');
?>
```

5. **Create uploads folder** — Make sure the `uploads/` directory exists and is writable:

```bash
mkdir uploads
chmod 755 uploads
```

6. **Open in browser** — Navigate to:
```
http://localhost/Complaint-system/index.php
```

---

## 🔐 Default Admin Credentials

> ⚠️ Change these before deploying to production!

| Field    | Value   |
|----------|---------|
| Username | `admin` |
| Password | `123`   |

---

## 🗺️ User Flow

```
Register → Login → User Dashboard → Submit Complaint → View Status
                                                           ↑
                                               Admin: Approve / Reject
```

---

## ⚠️ Known Issues & Improvement Suggestions

| Issue | Recommendation |
|-------|---------------|
| Passwords stored in plain text | Use `password_hash()` and `password_verify()` |
| Admin credentials hardcoded in `index.php` | Store roles in DB only; remove hardcoded check |
| No CSRF protection on forms | Add CSRF tokens to all forms |
| `delete.php` has `die()` before actual delete | Remove `die()` to enable deletion |
| File upload has no type/size validation | Validate file type (images only) and size limit |
| No user dashboard for complaint history | Add a user-facing view to track own complaints |

---

## 🧑‍💻 Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP (procedural) |
| Database | MySQL with MySQLi |
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Server | Apache (XAMPP/WAMP) |
| JS | Vanilla JavaScript |

---

## 📄 License

This project is intended for educational purposes. Feel free to use and modify it.
