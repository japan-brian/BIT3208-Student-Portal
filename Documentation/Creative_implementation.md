# Creative Implementation — Beyond Brief

## 1. Role-Based Access Control (Week 7 Bonus)
Three-tier system (Student/Lecturer/Admin) with conditional dashboard 
rendering — admins see user management, others don't.

## 2. Brute-Force Protection (Week 7 Bonus)
Account locks for 5 minutes after 3 failed login attempts, tracked via 
login_attempts and locked_until columns — a real security pattern used 
in production systems.

## 3. Remember Me (Week 7 Bonus)
7-day persistent cookie login using secure cookie practices.

## 4. Prepared Statements Throughout (Week 6 Security)
Migrated all queries from string concatenation to bind_param — eliminates 
SQL injection vector entirely, not just sanitization.

## 5. Dual CRUD Domains (Week 6 Practical Task 2)
Built both Student Management AND Library Management on the same auth 
backbone — demonstrates the auth system is reusable infrastructure, not 
a one-off feature.

## 6. Live Client-Side Validation (Week 3 Upgrade)
Real-time keyup validation feedback rather than only on-submit — closer 
to how production forms (Google, banking apps) behave.

## 7. Dashboard Analytics
Live COUNT() queries rendering real-time stats instead of static numbers — 
shows database is actively driving the UI, not just storing data.