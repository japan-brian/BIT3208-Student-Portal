<?php
session_start();
require_once '../includes/db.php';
/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) { header("Location: ../login.php"); exit(); }

$error = ""; $success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name  = trim($_POST['full_name']);
    $reg_number = trim($_POST['reg_number']);
    $course     = trim($_POST['course']);
    $year       = intval($_POST['year_of_study']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);

    if (empty($full_name) || empty($reg_number) || empty($course) || !$year) {
        $error = "Full name, reg number, course and year are required.";
    } else {
        $check = $conn->prepare("SELECT id FROM students WHERE reg_number=?");
        $check->bind_param("s", $reg_number);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Registration number already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO students (full_name, reg_number, course, year_of_study, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiss", $full_name, $reg_number, $course, $year, $email, $phone);
            if ($stmt->execute()) {
                $success = "Student added. <a href='view.php'>View all</a>.";
            } else {
                $error = "Failed: " . $conn->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student – EduTrack</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="form-box" style="max-width:520px;">
        <h2>Add New Student</h2>
        <p class="subtitle">EduTrack – Student Management</p>
        <?php if ($error): ?><div class="alert error"><?= $error ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert success"><?= $success ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group"><label>Full Name *</label>
                <input type="text" name="full_name" required value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>"></div>
            <div class="form-group"><label>Reg Number *</label>
                <input type="text" name="reg_number" placeholder="MKU/2022/001" required value="<?= htmlspecialchars($_POST['reg_number'] ?? '') ?>"></div>
            <div class="form-group"><label>Course *</label>
                <input type="text" name="course" required value="<?= htmlspecialchars($_POST['course'] ?? '') ?>"></div>
            <div class="form-group"><label>Year of Study *</label>
                <select name="year_of_study" required>
                    <option value="">-- Select Year --</option>
                    <?php for ($i=1;$i<=4;$i++): ?>
                    <option value="<?=$i?>" <?= (($_POST['year_of_study']??'')==$i)?'selected':'' ?>>Year <?=$i?></option>
                    <?php endfor; ?>
                </select></div>
            <div class="form-group"><label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></div>
            <div class="form-group"><label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"></div>
            <button type="submit" class="btn">Add Student</button>
        </form>
        <p class="switch-link"><a href="../dashboard.php">← Dashboard</a></p>
    </div>
</div>
</body>
</html>