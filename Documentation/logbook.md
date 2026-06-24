# BIT3208 – Advanced Web Design and Development
## Logbook
**Student:** Brian Kikuyu  
**Reg No:** BIT/2022/001  
**Institution:** Mount Kenya University – Thika Main Campus  
**Year/Semester:** Year 3, Semester 1

---

## Week 1 – Environment Setup
**Date:** 1st May 2026

**What I did:**
- Installed XAMPP on Windows
- Started Apache and MySQL services from XAMPP Control Panel
- Created a Hello World PHP page at htdocs/hello.php
- Tested localhost successfully in browser
- Tested basic database connectivity via phpMyAdmin

**Problems faced:** Apache port conflict with Skype — changed port to 8080  
**How I solved it:** Changed Apache port from 80 to 8080 in httpd.conf file

**Reflection:**  
Setting up a localhost environment gave me a clear picture of how a web server 
works locally before deployment. I now understand that Apache handles HTTP 
requests and MySQL handles data storage — two separate services working together.

---

## Week 2 – Wireframes and GUI Design
**Date:** 6th May 2026

**What I did:**
- Designed wireframes for the EduTrack (login, register, dashboard, CRUD pages)
- Planned the project workflow: auth first, then CRUD
- Selected technologies: PHP, MySQL, HTML, CSS, JavaScript
- Sketched GUI layouts for all main pages

**Problems faced:** Deciding which fields to include in the students table  
**How I solved it:** Reviewed sample student management systems and settled on: full_name, reg_number, course, year_of_study, email, phone

**Reflection:**  
Wireframing before coding forced me to think about user flow first. I realized 
how many pages a simple system needs — login, register, dashboard, add, view, 
edit, delete. Planning this upfront saved time during development.

---

## Week 3 – JavaScript, DOM and PHP Basics
**Date:** 10th May 2026

**What I did:**
- Implemented JavaScript form validation (required fields, password match)
- Practiced DOM manipulation — showing/hiding error messages dynamically
- Tested PHP syntax: variables, conditionals, loops
- Practiced basic PHP database connection using mysqli_connect()

**Problems faced:** Mixing up GET and POST methods — form data not appearing in PHP  
**How I solved it:** Learned that GET shows data in URL (good for search), POST hides it (good for passwords). Switched form method to POST.

**Reflection:**  
JavaScript validation runs on the client side before the form even reaches PHP. 
PHP validation runs on the server. I learned both are necessary — JS for 
user experience, PHP for security, since JS can be bypassed.

---

## Week 4 – Forms, Authentication and Sessions
**Date:** 21st May 2026

**What I did:**
- Built registration form with server-side validation
- Built login form with password_hash() and password_verify()
- Implemented PHP sessions — storing user_id and username after login
- Created dashboard protected by session check
- Organized project into professional folder structure with includes/, css/, students/
- Exported week4db.sql for version control
- Pushed Week4 folder to GitHub

**Problems faced:** Session not persisting across pages  
**How I solved it:** Confirmed session_start() is at top of every file before any HTML output

**Reflection:**  
Passwords must never be stored as plain text. password_hash() generates a 
unique hash each time — even the same password produces a different hash. 
Sessions work like a temporary ID card — once logged in, every page checks 
that card before showing content. Without session_start() on every page, 
the session doesn't exist.

---

## Week 5 – Database CRUD Operations
**Date:** 2nd June 2026

**What I did:**
- Created week5db with users and students tables
- Built add.php — INSERT query to add new student records
- Built view.php — SELECT query displaying all students in a table
- Built edit.php — UPDATE query pre-filled with existing data
- Built delete.php — DELETE query with confirmation prompt
- Connected dashboard stats to live COUNT() queries from the database
- Exported week5db.sql and pushed Week5 to GitHub

**Problems faced:** busres table appearing — wrong db selected in phpMyAdmin  
**How I solved it:** Dropped the table, confirmed db.php pointed to week5db

**Reflection:**  
CRUD is the foundation of almost every real system — banking, hospital records, 
e-commerce. Building it manually in raw PHP and SQL made me understand exactly 
what frameworks like Laravel do automatically. I also learned that UPDATE without 
a WHERE clause would overwrite every record — always check your WHERE conditions.

---

**Final Submission Date:** 11th June 2026

**Student Signature:** Kikuyu Brian Japan 
**Date:** 11th June 2026