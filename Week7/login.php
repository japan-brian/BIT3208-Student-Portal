<?php
session_start();
require_once 'includes/db.php';
/** @var mysqli $conn */

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, username, password, role, login_attempts, locked_until FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            $locked = false;
            if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {
                $locked = true;
                $error = "Account locked until " . date('H:i:s', strtotime($user['locked_until']));
            }

            if (!$locked && password_verify($password, $user['password'])) {
                $stmt = $conn->prepare("UPDATE users SET login_attempts = 0, locked_until = NULL WHERE id = ?");
                $stmt->bind_param("i", $user['id']);
                $stmt->execute();
                $stmt->close();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($remember) {
                    setcookie('remember_user', $user['id'], time() + 604800, '/', '', false, true);
                }

                header("Location: dashboard.php");
                exit();
            } else {
                if (!$locked) {
                    $attempts = $user['login_attempts'] + 1;
                    $locked_until = null;
                    if ($attempts >= 3) {
                        $locked_until = date('Y-m-d H:i:s', strtotime('+5 minutes'));
                        $error = "Too many failed attempts. Account locked for 5 minutes.";
                    } else {
                        $error = "Invalid credentials. Attempt $attempts of 3.";
                    }
                    $stmt = $conn->prepare("UPDATE users SET login_attempts = ?, locked_until = ? WHERE id = ?");
                    $stmt->bind_param("isi", $attempts, $locked_until, $user['id']);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – EduTrack</title>
    <link rel="stylesheet" href="assets/css/style.css?v=2">
</head>
<body>
<div class="container">
    <div class="form-box">
        <h2>Welcome Back</h2>
        <p class="subtitle">EduTrack – Student Portal</p>
        <?php if ($error): ?><div class="alert error"><?= $error ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group"><label>Username</label><input type="text" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
            <div class="form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="remember" id="remember" <?= isset($_POST['remember']) ? 'checked' : '' ?>>
                <label for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="switch-link">Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>
</body>
</html>