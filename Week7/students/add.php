<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$error   = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name    = trim($_POST['full_name']);
    $reg_number   = trim($_POST['reg_number']);
    $course       = trim($_POST['course']);
    $year         = intval($_POST['year_of_study']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);

    if (empty($full_name) || empty($reg_number) || empty($course) || empty($year)) {
        $error = "Full name, reg number, course and year are required.";
    } else {
        $check = mysqli_query($conn, "SELECT id FROM students WHERE reg_number='$reg_number'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Registration number already exists.";
        } else {
            $sql = "INSERT INTO students (full_name, reg_number, course, year_of_study, email, phone)
                    VALUES ('$full_name', '$reg_number', '$course', '$year', '$email', '$phone')";
            if (mysqli_query($conn, $sql)) {
                $success = "Student added successfully. <a href='view.php'>View all students</a>.";
            } else {
                $error = "Failed to add student: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student – Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="form-box" style="max-width:520px;">
        <h2>Add New Student</h2>
        <p class="subtitle">BIT3208 EduTrack</p>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="full_name" placeholder="e.g. Brian Kikuyu"
                       value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label>Registration Number *</label>
                <input type="text" name="reg_number" placeholder="e.g. MKU/2022/001"
                       value="<?= isset($_POST['reg_number']) ? htmlspecialchars($_POST['reg_number']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label>Course *</label>
                <input type="text" name="course" placeholder="e.g. BSc Computer Science"
                       value="<?= isset($_POST['course']) ? htmlspecialchars($_POST['course']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label>Year of Study *</label>
                <select name="year_of_study" required>
                    <option value="">-- Select Year --</option>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <option value="<?= $i ?>" <?= (isset($_POST['year_of_study']) && $_POST['year_of_study'] == $i) ? 'selected' : '' ?>>
                            Year <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="student@email.com"
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="07xxxxxxxx"
                       value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
            </div>
            <button type="submit" class="btn">Add Student</button>
        </form>
        <p class="switch-link"><a href="../dashboard.php">← Back to Dashboard</a></p>
    </div>
</div>
</body>
</html>