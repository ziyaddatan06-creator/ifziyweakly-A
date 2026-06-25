<?php ?>
<!DOCTYPE html>
<html lang="id"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Lionel Messi</title>
    <link rel="stylesheet" href="asset/css/index.css">
</head>

<body>

<div class="container">
    <header class="site-header">
        <h1 class="site-title">⚽ LIONEL MESSI ⚽</h1>
        
        <nav class="site-nav">
            <a href="index.php" class="active">Home</a>
            <a href="profile.php">Profile</a>
            <a href="contact.php">Contact</a>
            <a href="statistik.php">Statistik</a>
            <a href="mahasiswa.php">Mahasiswa</a>
        </nav>
    </header>

    <main class="main-content">
        <section class="hero-section">
            <figure class="hero-figure">
                <img src="images/asset/messi1.jpg" alt="Lionel Messi" class="hero-img">
                <figcaption class="hero-caption">Lionel Messi - Sang Legenda Sepak Bola Dunia</figcaption>
            </figure>
        </section>

        <section class="intro-section">
            <h2 class="section-title">🎯 Selamat Datang</h2>
            
            <p class="intro-text">
                Selamat datang di website khusus buat kamu para fans Lionel Messi! Inilah tempat terbaik untuk menggali lebih dalam tentang salah satu pemain sepak bola terbaik sepanjang masa.
            </p>

            <p class="intro-text">
                Website ini menyediakan informasi lengkap mulai dari profil detail, statistik permainan yang menakjubkan, hingga pencapaian-pencapaian spektakuler yang membuat nama Messi dikenal di seluruh dunia.
            </p>

            <p class="intro-text">
                Jelajahi setiap menu untuk menemukan informasi menarik tentang perjalanan karir, gaya bermain luar biasa, dan dedikasi yang membuat Messi menjadi legenda abadi dalam sejarah sepak bola.
            </p>
        </section>

        <section class="achievements-section">
            <h2 class="section-title">🏆 Pencapaian Utama</h2>
            
            <div class="achievements-grid">
                <div class="achievement-card">
                    <h3 class="achievement-title">🏅 Barcelona</h3>
                    <ul class="achievement-list">
                        <li><strong>La Liga:</strong> 9x Juara</li>
                        <li><strong>Champions League:</strong> 4x Juara</li>
                        <li><strong>Copa del Rey:</strong> 6x Juara</li>
                        <li><strong>Supercopa Spanyol:</strong> 8x</li>
                    </ul>
                </div>

                <div class="achievement-card">
                    <h3 class="achievement-title">🇦🇷 Tim Nasional Argentina</h3>
                    <ul class="achievement-list">
                        <li><strong>Piala Dunia:</strong> 2022 🥇</li>
                        <li><strong>Copa América:</strong> 2021, 2024</li>
                        <li><strong>Finalissima:</strong> 2022</li>
                        <li><strong>Pemain Terbaik Dunia</strong></li>
                    </ul>
                </div>

                <div class="achievement-card">
                    <h3 class="achievement-title">⭐ Penghargaan Individual</h3>
                    <ul class="achievement-list">
                        <li><strong>Ballon d'Or:</strong> 8x (Rekor)</li>
                        <li><strong>FIFA The Best:</strong> Multiple</li>
                        <li><strong>Top Scorer Liga:</strong> Berkali-kali</li>
                        <li><strong>Player of the Year</strong></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <h2 class="section-title">📖 Jelajahi Lebih Lanjut</h2>
            <p class="cta-text">Gunakan menu navigasi di atas untuk melihat profil lengkap, statistik detail, dan berbagai informasi menarik lainnya tentang Messi.</p>
            
            <div class="cta-links">
                <a href="profile.php" class="cta-btn">👤 Lihat Profil</a>
                <a href="statistik.php" class="cta-btn">📊 Lihat Statistik</a>
                <a href="contact.php" class="cta-btn">💬 Hubungi Kami</a>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="https://id.wikipedia.org/wiki/Lionel_Messi" target="_blank" title="Wikipedia">📚 Wikipedia</a> |
                <a href="https://www.instagram.com/leomessi/" target="_blank" title="Instagram">📸 Instagram</a>
            </div>
            <p class="footer-text">&copy; <?php echo date('Y'); ?> Lionel Messi Fans Page | All Rights Reserved</p>
        </div>
    </footer>
</div>

</body>
</html>
