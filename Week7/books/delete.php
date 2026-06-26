<?php
session_start();
require_once '../includes/db.php';
/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) { header("Location: ../login.php"); exit(); }

$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("DELETE FROM books WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: view.php");
exit();
?>