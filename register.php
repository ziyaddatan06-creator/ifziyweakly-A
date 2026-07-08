<?php
session_start();
require_once 'koneksi.php';

$errors = '';
$username = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $passwordConfirm = trim($_POST['confirm_password'] ?? '');

    if ($username === '' || $password === '' || $passwordConfirm === '') {
        $errors = 'Semua field harus diisi.';
    } elseif ($password !== $passwordConfirm) {
        $errors = 'Password dan konfirmasi password tidak cocok.';
    } else {
        $query = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $query->bind_param('s', $username);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $errors = 'Username sudah digunakan. Pilih username lain.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $insert->bind_param('ss', $username, $passwordHash);
            if ($insert->execute()) {
                header('Location: login.php?registered=1');
                exit;
            }
            $errors = 'Terjadi kesalahan saat membuat akun. Coba lagi.';
        }

        $query->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Lionel Messi</title>
    <link rel="stylesheet" href="asset/css/login.css">
</head>
<body>
    <div class="container">
        <header class="site-header">
            <h1 class="site-title">Daftar Akun</h1>
            <nav class="site-nav">
                <a href="index.php">Home</a>
                <a href="profile.php">Profile</a>
                <a href="contact.php">Contact</a>
                <a href="statistik.php">Statistik</a>
                <a href="mahasiswa.php">Mahasiswa</a>
                <a href="login.php">Login</a>
            </nav>
        </header>

        <main class="main-content">
            <section class="login-card">
                <h2>Daftar pengguna baru</h2>
                <p class="login-intro">Buat akun untuk mengakses fitur tambahan di website.</p>

                <?php if ($errors) : ?>
                    <div class="alert error"><?php echo $errors; ?></div>
                <?php endif; ?>

                <form action="register.php" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Pilih username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Masukkan kembali password" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-login">Daftar</button>
                </form>

                <p class="hint">Sudah punya akun? <a href="login.php">Masuk di sini</a>.</p>
            </section>
        </main>
    </div>
</body>
</html>
