<?php
session_start();
require_once 'includes/db.php';
/** @var mysqli $conn */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname  = trim($_POST['fullname']);
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];
    $role      = $_POST['role'] ?? 'student';

    $errors = [];
    if (empty($fullname) || empty($username) || empty($email) || empty($password))
        $errors[] = "All fields are required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Invalid email format.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Username or email already taken.";
        }
        $stmt->close();
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullname, $username, $email, $hashed, $role);
        if ($stmt->execute()) {
            $success = "Registration successful. <a href='login.php'>Login now</a>";
        } else {
            $errors[] = "DB error: " . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – EduTrack</title>
    <link rel="stylesheet" href="assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="form-box">
        <h2>Create Account</h2>
        <p class="subtitle">EduTrack – Student Portal</p>
        <?php if (!empty($errors)): ?>
            <div class="alert error"><?= implode('<br>', $errors) ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group"><label>Full Name</label><input type="text" name="fullname" required value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>"></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-group"><label>Role</label>
                <select name="role" required>
                    <option value="student" <?= (($_POST['role'] ?? '') == 'student') ? 'selected' : '' ?>>Student</option>
                    <option value="lecturer" <?= (($_POST['role'] ?? '') == 'lecturer') ? 'selected' : '' ?>>Lecturer</option>
                    <option value="admin" <?= (($_POST['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <p class="switch-link">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>
</body>
</html>