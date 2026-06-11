<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_id  = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user   = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Student Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="dashboard-wrapper">
        <div class="topbar">
            <h1>🎓 Student Portal</h1>
            <span>Welcome, <?= htmlspecialchars($username) ?> &nbsp;|&nbsp; <a href="logout.php" style="color:#e63946;">Logout</a></span>
        </div>

        <div class="card">
            <h3>My Account</h3>
            <table>
                <tr><th>ID</th><td><?= $user['id'] ?></td></tr>
                <tr><th>Username</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
                <tr><th>Email</th><td><?= htmlspecialchars($user['email']) ?></td></tr>
                <tr><th>Joined</th><td><?= $user['created_at'] ?></td></tr>
            </table>
        </div>

        <div class="card">
            <h3>Quick Navigation</h3>
            <div class="nav-links">
    <a href="students/add.php">+ Add Student</a>
    <a href="students/view.php">📋 View Students</a>
    <a href="logout.php" class="logout">Logout</a>
</div>
        </div>
    </div>
</div>
</body>
</html>