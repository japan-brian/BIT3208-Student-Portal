<?php
session_start();
require_once 'includes/db.php';
/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// User details
$stmt = $conn->prepare("SELECT id, username, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Count students
$stmt = $conn->prepare("SELECT COUNT(*) as c FROM students");
$stmt->execute();
$total_students = $stmt->get_result()->fetch_assoc()['c'];
$stmt->close();

// Year counts
$year_counts = [];
for ($y = 1; $y <= 4; $y++) {
    $stmt = $conn->prepare("SELECT COUNT(*) as c FROM students WHERE year_of_study = ?");
    $stmt->bind_param("i", $y);
    $stmt->execute();
    $year_counts[$y] = $stmt->get_result()->fetch_assoc()['c'];
    $stmt->close();
}

// ═══ NEW: Count books ═══
$stmt = $conn->prepare("SELECT COUNT(*) as c FROM books");
$stmt->execute();
$total_books = $stmt->get_result()->fetch_assoc()['c'];
$stmt->close();
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

        <!-- Stats row – 4 cards now -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total Students</div>
                <div class="stat-value"><?= $total_students ?></div>
            </div>
            <div class="stat-card green">
                <div class="stat-label">Year 1 & 2</div>
                <div class="stat-value"><?= $year_counts[1] + $year_counts[2] ?></div>
            </div>
            <div class="stat-card orange">
                <div class="stat-label">Year 3 & 4</div>
                <div class="stat-value"><?= $year_counts[3] + $year_counts[4] ?></div>
            </div>
            <!-- ═══ NEW: Library Books stat ═══ -->
            <div class="stat-card purple">
                <div class="stat-label">Library Books</div>
                <div class="stat-value"><?= $total_books ?></div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <h3>⚡ Quick Actions</h3>
            <div class="nav-links">
                <a href="students/add.php">＋ Add Student</a>
                <a href="students/view.php" class="secondary">📋 View All Students</a>
                <!-- ═══ NEW: Library link ═══ -->
                <a href="books/view.php" class="secondary">📚 Library</a>
                <a href="logout.php" class="logout">⏻ Logout</a>
            </div>
        </div>

        <!-- User info -->
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