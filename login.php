<?php
require_once __DIR__ . '/security.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = $_SESSION['error'] ?? "";
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - UJK</title>
<link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&family=Libre+Caslon+Text:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="atelier/atelier.css">
<link rel="stylesheet" href="atelier/theme.css">
<script src="atelier/theme.js"></script>
<script src="atelier/atelier.js"></script>
</head>
<body>
    <h2>Login Aplikasi Manajemen Buku</h2>

    <?php if ($error != ""): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
            <?php echo csrf_field(); ?>
        <p>
            <label>Email</label><br>
            <input type="email" name="email" required>
        </p>

        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>

        <button type="submit">Login</button>
    </form>
</body>
</html>