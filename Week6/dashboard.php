<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_id  = $_SESSION['user_id'];

$user_result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user        = mysqli_fetch_assoc($user_result);

$total      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students"))['c'];
$year1      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students WHERE year_of_study=1"))['c'];
$year2      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students WHERE year_of_study=2"))['c'];
$year3      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students WHERE year_of_study=3"))['c'];
$year4      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students WHERE year_of_study=4"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – EduTrack</title>
    <link rel="stylesheet" href="assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="dashboard-wrapper">

        <div class="topbar">
            <h1>🎓 EduTrack</h1>
            <span>Welcome back, <strong style="color:white;"><?= htmlspecialchars($username) ?></strong> &nbsp;|&nbsp;
                <a href="logout.php">Logout</a></span>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total Students</div>
                <div class="stat-value"><?= $total ?></div>
            </div>
            <div class="stat-card green">
                <div class="stat-label">Year 1 & 2</div>
                <div class="stat-value"><?= $year1 + $year2 ?></div>
            </div>
            <div class="stat-card orange">
                <div class="stat-label">Year 3 & 4</div>
                <div class="stat-value"><?= $year3 + $year4 ?></div>
            </div>
        </div>

        <div class="card">
            <h3>⚡ Quick Actions</h3>
            <div class="nav-links">
                <a href="students/add.php">＋ Add Student</a>
                <a href="students/view.php" class="secondary">📋 View All Students</a>
                <a href="logout.php" class="logout">⏻ Logout</a>
            </div>
        </div>

        <div class="card">
            <h3>👤 My Account</h3>
            <table>
                <tr><th>Username</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
                <tr><th>Email</th><td><?= htmlspecialchars($user['email']) ?></td></tr>
                <tr><th>Joined</th><td><?= $user['created_at'] ?></td></tr>
            </table>
        </div>

    </div>
</div>
</body>
</html>