<?php
session_start();
require_once '../includes/db.php';
/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) { header("Location: ../login.php"); exit(); }

$result = $conn->query("SELECT * FROM books ORDER BY created_at DESC");
$books  = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library – Books</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="dashboard-wrapper">
        <div class="topbar">
            <h1>📚 Library Management</h1>
            <span><a href="../logout.php">Logout</a></span>
        </div>
        <div class="card">
            <h3>All Books (<?= count($books) ?>)</h3>
            <div class="nav-links">
                <a href="add.php">+ Add Book</a>
                <a href="../dashboard.php" class="secondary">← Dashboard</a>
            </div>
            <?php if (count($books) === 0): ?>
                <p style="color:#888; padding:20px;">No books yet. <a href="add.php">Add one</a>.</p>
            <?php else: ?>
            <table>
                <thead><tr><th>#</th><th>Title</th><th>Author</th><th>Category</th><th>Code</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($books as $i => $b): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= htmlspecialchars($b['title']) ?></td>
                    <td><?= htmlspecialchars($b['author']) ?></td>
                    <td><?= htmlspecialchars($b['category']) ?></td>
                    <td><?= htmlspecialchars($b['book_code']) ?></td>
                    <td><?= $b['available'] ? '<span class="badge year1">Available</span>' : '<span class="badge year4">Borrowed</span>' ?></td>
                    <td>
                        <a href="delete.php?id=<?= $b['id'] ?>" onclick="return confirm('Delete this book?')" class="btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>