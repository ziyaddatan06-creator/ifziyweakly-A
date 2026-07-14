<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Lionel Messi</title>
    <link rel="stylesheet" href="asset/css/contact.css">
</head>
<body>

<div class="container">
    <header class="site-header">
        <h1 class="site-title">LIONEL MESSI</h1>

        <nav class="site-nav">
            <a href="index.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="contact.php" class="active">Contact</a>
            <a href="statistik.php">Statistik</a>
            <a href="mahasiswa.php">Mahasiswa</a>
            <?php if (!empty($_SESSION['logged_in'])) : ?>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else : ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="contact-section">
            <div class="contact-wrapper">
                <form class="contact-form" action="" method="POST">
                    <div class="form-group">
                        <label for="nama">👤 Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="email">✉️ Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="subjek">📝 Subjek</label>
                        <input type="text" id="subjek" name="subjek" placeholder="Judul pesan Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="pesan">💬 Pesan</label>
                        <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." rows="6" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="submit-btn">✈️ Kirim Pesan</button>
                </form>
            </div>
        </section>

        <?php
        if (isset($_POST['submit'])) {
            $nama   = htmlspecialchars($_POST['nama']);
            $email  = htmlspecialchars($_POST['email']);
            $subjek = htmlspecialchars($_POST['subjek']);
            $pesan  = htmlspecialchars($_POST['pesan']);
        ?>
            <section class="success-message">
                <div class="success-box">
                    <h3>✅ Pesan Anda Berhasil Dikirim!</h3>
                    <p><strong>Nama:</strong> <?php echo $nama; ?></p>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Subjek:</strong> <?php echo $subjek; ?></p>
                    <p><strong>Pesan:</strong></p>
                    <p class="message-text"><?php echo nl2br($pesan); ?></p>
                    <p class="thanks-text">Terima kasih sudah menghubungi kami! Kami akan membalas pesan Anda segera.</p>
                </div>
            </section>
        <?php } ?>

        <section class="social-section">
            <h2 class="section-title">🌐 Ikuti Kami</h2>
            <p class="social-intro">Ikuti Lionel Messi di media sosial resmi:</p>
            <div class="social-links">
                <a href="https://www.instagram.com/leomessi/" target="_blank" class="social-btn">📸 Instagram</a>
                <a href="https://www.wikipedia.org/wiki/Lionel_Messi" target="_blank" class="social-btn">📚 Wikipedia</a>
                <a href="https://id.wikipedia.org/wiki/Lionel_Messi" target="_blank" class="social-btn">🇮🇩 Wiki Indonesia</a>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; <?php echo date('Y'); ?> Lionel Messi Fans Page | All Rights Reserved</p>
    </footer>
</div>

</body>
</html>
