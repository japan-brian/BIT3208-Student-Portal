<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$error   = "";
$success = "";

$id     = intval($_GET['id'] ?? 0);
$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");

if (mysqli_num_rows($result) === 0) {
    header("Location: view.php");
    exit();
}

$student = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name  = trim($_POST['full_name']);
    $reg_number = trim($_POST['reg_number']);
    $course     = trim($_POST['course']);
    $year       = intval($_POST['year_of_study']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);

    if (empty($full_name) || empty($reg_number) || empty($course) || empty($year)) {
        $error = "Full name, reg number, course and year are required.";
    } else {
        $check = mysqli_query($conn, "SELECT id FROM students WHERE reg_number='$reg_number' AND id != $id");
        if (mysqli_num_rows($check) > 0) {
            $error = "That registration number belongs to another student.";
        } else {
            $sql = "UPDATE students SET
                        full_name    = '$full_name',
                        reg_number   = '$reg_number',
                        course       = '$course',
                        year_of_study = '$year',
                        email        = '$email',
                        phone        = '$phone'
                    WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                $success  = "Student updated successfully.";
                $student  = array_merge($student, compact('full_name','reg_number','course','year','email','phone'));
            } else {
                $error = "Update failed: " . mysqli_error($conn);
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
    <title>Edit Student – Portal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="form-box" style="max-width:520px;">
        <h2>Edit Student</h2>
        <p class="subtitle">Editing: <?= htmlspecialchars($student['full_name']) ?></p>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="full_name" value="<?= htmlspecialchars($student['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Registration Number *</label>
                <input type="text" name="reg_number" value="<?= htmlspecialchars($student['reg_number']) ?>" required>
            </div>
            <div class="form-group">
                <label>Course *</label>
                <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" required>
            </div>
            <div class="form-group">
                <label>Year of Study *</label>
                <select name="year_of_study" required>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <option value="<?= $i ?>" <?= $student['year_of_study'] == $i ? 'selected' : '' ?>>
                            Year <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>">
            </div>
            <button type="submit" class="btn">Update Student</button>
        </form>
        <p class="switch-link"><a href="view.php">← Back to Students</a></p>
    </div>
</div>
</body>
</html>