<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$result   = mysqli_query($conn, "SELECT * FROM students ORDER BY created_at DESC");
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students – Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="dashboard-wrapper">
        <div class="topbar">
            <h1>🎓 Student Portal</h1>
            <span>Logged in: <?= htmlspecialchars($_SESSION['username']) ?> &nbsp;|&nbsp;
                <a href="../logout.php" style="color:#e63946;">Logout</a></span>
        </div>

        <div class="card">
            <h3>All Students (<?= count($students) ?> records)</h3>
            <div class="nav-links" style="margin-bottom:16px;">
                <a href="add.php">+ Add Student</a>
                <a href="../dashboard.php" style="background:#6c757d;">← Dashboard</a>
            </div>

            <?php if (count($students) === 0): ?>
                <p style="color:#888; text-align:center; padding:20px;">No students found. <a href="add.php">Add one</a>.</p>
            <?php else: ?>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Reg Number</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $i => $s): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($s['full_name']) ?></td>
                            <td><?= htmlspecialchars($s['reg_number']) ?></td>
                            <td><?= htmlspecialchars($s['course']) ?></td>
                            <td><span class="badge year<?= $s['year_of_study'] ?>">Year <?= $s['year_of_study'] ?></span></td>
                            <td><?= htmlspecialchars($s['email']) ?></td>
                            <td><?= htmlspecialchars($s['phone']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $s['id'] ?>" class="btn-secondary" style="margin-right:6px;">Edit</a>
                                <a href="delete.php?id=<?= $s['id'] ?>"
                                   onclick="return confirm('Delete <?= htmlspecialchars($s['full_name']) ?>?')"
                                   class="btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>