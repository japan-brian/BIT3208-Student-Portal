# BIT3208 – Advanced Web Design and Development
## Project Report: PHP & MySQL EduTrack

**Student:** Kikuyu Brian Japan
**Reg No:** BSCCS/2024/74678  
**Institution:** Mount Kenya University – Thika Main Campus  
**Lecturer:** Michael Nyoro 
**Date:** 11th June 2026

---

## 1. Introduction

This report documents the development of a PHP and MySQL EduTrack 
built as part of the BIT3208 Advanced Web Design and Development coursework. 
The system covers server-side programming, user authentication, session 
management, and full CRUD database operations across Weeks 4 and 5 of the 
course.

---

## 2. Project Objectives

- Implement server-side form processing using PHP
- Build a secure authentication system with hashed passwords
- Manage user state using PHP sessions
- Perform full CRUD operations on a MySQL database
- Structure a project professionally for maintainability
- Practice version control using Git and GitHub

---

## 3. Technologies Used

| Technology | Purpose |
|------------|---------|
| PHP 8.x | Server-side scripting |
| MySQL | Relational database |
| XAMPP | Local development environment |
| HTML5/CSS3 | Frontend structure and styling |
| JavaScript | Client-side form validation |
| Git/GitHub | Version control |

---

## 4. System Architecture

### Folder Structure
BIT3208_Project/

├── Week4/

│   ├── index.php

│   ├── login.php

│   ├── register.php

│   ├── dashboard.php

│   ├── logout.php

│   ├── css/style.css

│   ├── includes/db.php

│   └── database/week4db.sql

└── Week5/

├── (all Week4 files +)

└── students/

├── add.php

├── view.php

├── edit.php

└── delete.php

### Database Schema

**users table**
| Column | Type | Description |
|--------|------|-------------|
| id | INT AUTO_INCREMENT | Primary key |
| username | VARCHAR(100) | Unique username |
| email | VARCHAR(150) | Unique email |
| password | VARCHAR(255) | Bcrypt hash |
| created_at | TIMESTAMP | Auto-set on insert |

**students table**
| Column | Type | Description |
|--------|------|-------------|
| id | INT AUTO_INCREMENT | Primary key |
| full_name | VARCHAR(150) | Student full name |
| reg_number | VARCHAR(50) | Unique reg number |
| course | VARCHAR(100) | Course name |
| year_of_study | INT | Year 1–4 |
| email | VARCHAR(150) | Contact email |
| phone | VARCHAR(20) | Phone number |
| created_at | TIMESTAMP | Auto-set on insert |

---

## 5. Features Implemented

### Week 4
- **Registration** – form validation, duplicate checking, password hashing
- **Login** – credential verification using password_verify()
- **Sessions** – user state persisted across pages via $_SESSION
- **Dashboard** – session-protected page showing account info
- **Logout** – session destruction and redirect

### Week 5
- **Add Student** – INSERT with duplicate reg number check
- **View Students** – SELECT all with responsive table display
- **Edit Student** – UPDATE with pre-filled form and conflict check
- **Delete Student** – DELETE with JavaScript confirmation prompt
- **Live Stats** – Dashboard COUNT() queries showing student totals by year

---

## 6. Security Considerations

- Passwords stored as bcrypt hashes using password_hash()
- All output escaped using htmlspecialchars() to prevent XSS
- Session authentication check on every protected page
- Integer inputs cast using intval() to prevent injection

---

## 7. Version Control

Weekly commits pushed to GitHub:

| Commit | Description |
|--------|-------------|
| Week4 initial | Folder structure + database setup |
| Week4 auth | Login, register, sessions, dashboard |
| Week5 CRUD | Add, view, edit, delete students |
| CSS upgrade | Upgraded styling across both weeks |

Repository: https://github.com/japan-brian/BIT3208-Student-Portal

---

## 8. Screenshots

[Add your screenshots here — register form, login, dashboard, 
add student, view table, edit form, delete confirmation, 
phpMyAdmin tables]

---

## 9. Challenges and Solutions

| Challenge | Solution |
|-----------|----------|
| $conn undefined warning in VS Code | Added @var mysqli docblock — runtime error not actual |
| CSS not updating in browser | Used ?v=2 cache-busting on stylesheet link |
| Wrong table created (busres) | Dropped table, confirmed db.php pointed to week5db |
| [add your own] | [your solution] |

---

## 10. Conclusion

This project demonstrated the full lifecycle of a database-driven web 
application — from environment setup through to CRUD operations. The 
most significant learning was understanding how PHP, MySQL, HTML and 
sessions work together as a system rather than in isolation. The version 
control workflow using Git reinforced professional development habits 
that apply directly to industry practice.
