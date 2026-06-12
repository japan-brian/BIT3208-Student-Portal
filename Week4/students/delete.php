<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id     = intval($_GET['id'] ?? 0);
$result = mysqli_query($conn, "SELECT id FROM students WHERE id = $id");

if (mysqli_num_rows($result) === 0) {
    header("Location: view.php");
    exit();
}

mysqli_query($conn, "DELETE FROM students WHERE id = $id");
header("Location: view.php");
exit();
?>