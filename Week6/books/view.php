<?php
session_start();
require_once '../includes/db.php';
/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch all books
$stmt = $conn->prepare("SELECT * FROM books ORDER BY created_at DESC");
$stmt->execute();
$books = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library – EduTrack</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="dashboard-wrapper">
        <div class="topbar">
            <h1>📚 Library</h1>
            <a href="../dashboard.php">← Dashboard</a>
        </div>

        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h3>All Books</h3>
                <!-- ═══ This is the correct link to add a book ═══ -->
                <a href="add.php" class="btn">＋ Add Book</a>
            </div>

            <?php if ($books->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Book Code</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while ($book = $books->fetch_assoc()): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= htmlspecialchars($book['category']) ?></td>
                            <td><?= htmlspecialchars($book['book_code']) ?></td>
                            <td><?= $book['available'] ? '✅ Yes' : '❌ No' ?></td>
                            <td>
                                <a href="delete.php?id=<?= $book['id'] ?>" onclick="return confirm('Delete this book?')">🗑️ Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No books yet. <a href="add.php">Add one now</a>.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>