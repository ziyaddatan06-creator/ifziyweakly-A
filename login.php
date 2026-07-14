<?php
session_start();
require_once 'koneksi.php';

// Jika belum ada user sama sekali di tabel `users`, arahkan ke halaman pendaftaran
$countRes = $conn->query('SELECT COUNT(*) AS c FROM users');
if ($countRes) {
    $row = $countRes->fetch_assoc();
    if (isset($row['c']) && intval($row['c']) === 0) {
        header('Location: register.php');
        exit;
    }
}

$errors = '';
$success = '';
$loggedIn = !empty($_SESSION['logged_in']);
$username = $_SESSION['user'] ?? '';

if (isset($_GET['logged_out'])) {
    $success = 'Anda telah berhasil logout.';
}

if (isset($_GET['registered'])) {
    $success = 'Pendaftaran berhasil. Silakan login dengan akun baru Anda.';
}

if (isset($_POST['login'])) {
    $inputUsername = trim($_POST['username'] ?? '');
    $inputPassword = trim($_POST['password'] ?? '');

    $query = $conn->prepare('SELECT password FROM users WHERE username = ?');
    $query->bind_param('s', $inputUsername);
    $query->execute();
    $query->bind_result($passwordHash);

    if ($query->fetch() && password_verify($inputPassword, $passwordHash)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $inputUsername;
        $query->close();
        header('Location: index.php');
        exit;
    }

    $query->close();
    $errors = '<strong>Login gagal!</strong><br>Username atau password salah.<br><br><a href="register.php" style="color: #007bff; text-decoration: underline;">➜ Belum punya akun? Buat akun baru</a>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lionel Messi</title>
    <link rel="stylesheet" href="asset/css/login.css">
</head>
<body>
    <div class="container">
        <header class="site-header">
            <h1 class="site-title">Login Fans Page</h1>
            <nav class="site-nav">
                <a href="index.php">Home</a>
                <a href="profile.php">Profile</a>
                <a href="contact.php">Contact</a>
                <a href="statistik.php">Statistik</a>
                <a href="mahasiswa.php">Mahasiswa</a>
                <?php if (!empty($_SESSION['logged_in'])) : ?>
                    <a href="logout.php" class="logout-btn">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="active">Login</a>
                <?php endif; ?>
            </nav>
        </header>

        <main class="main-content">
            <section class="login-card">
                <h2>Silakan masuk</h2>
                <p class="login-intro">Untuk menikmati akses tambahan, silakan masuk dengan akun admin.</p>

                <?php if ($success) : ?>
                    <div class="alert success"><?php echo $success; ?></div>
                <?php endif; ?>

                <?php if ($errors) : ?>
                    <div class="alert error"><?php echo $errors; ?></div>
                <?php endif; ?>

                <?php if ($loggedIn) : ?>
                    <div class="alert info">Anda sudah masuk sebagai <strong><?php echo htmlspecialchars($username); ?></strong>.</div>
                    <a href="logout.php" class="btn btn-logout">Logout</a>
                <?php else : ?>
                    <form action="login.php" method="POST" class="login-form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-login">Masuk</button>
                    </form>
                    <p class="hint">Belum punya akun? <a href="register.php">Buat akun baru di sini</a>.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
