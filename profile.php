<?php ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lionel Messi | Profil</title>

    <link rel="stylesheet" href="asset/css/profile.css">
</head>

<body>

    <div class="container">
        
        <header class="site-header">
            <h1 class="site-title">LIONEL MESSI</h1>

            <nav class="site-nav">
                <a href="index.php">Home</a>
                <a href="profile.php" class="active">Profile</a>
                <a href="contact.php">Contact</a>
                <a href="statistik.php">Statistik</a>
                <a href="mahasiswa.php">Mahasiswa</a>
            </nav>
        </header>

        <img src="images/asset/messi1.jpg" class="profile-img" alt="Lionel Messi">

        <div class="profile-details">

            <h2 class="section-title">Biodata Dasar</h2>
            <ul class="profile-list">
                <li><strong>Nama Lengkap:</strong> Lionel Andrés Messi</li>
                <li><strong>Tanggal Lahir:</strong> 24 Juni 1987 
                    <?php 
                        $tanggal_lahir = new DateTime("1987-06-24");
                        $hari_ini = new DateTime();
                        $umur = $hari_ini->diff($tanggal_lahir);
                        echo "(Umur " . $umur->y . " Tahun)";
                    ?>
                </li>
                <li><strong>Tempat Lahir:</strong> Rosario, Argentina</li>
                <li><strong>Tinggi:</strong> 170 cm</li>
                <li><strong>Posisi:</strong> Penyerang (Forward)</li>
                <li><strong>Klub Saat Ini:</strong> Inter Miami CF</li>
            </ul>

            <h2 class="section-title">Karakter & Gaya Bermain</h2>
            <ul class="profile-list">
                <li><strong>Kelebihan:</strong> Dribbling cepat dan kontrol bola luar biasa</li>
                <li><strong>Visi Bermain:</strong> Umpan akurat dan kreativitas tinggi</li>
                <li><strong>Finishing:</strong> Tajam dalam mencetak gol</li>
                <li><strong>Ciri Khas:</strong> Lari cepat dengan bola menempel di kaki</li>
            </ul>

            <h2 class="section-title">Prestasi & Fakta Menarik</h2>
            <ul class="profile-list">
                <li><strong>Ballon d'Or:</strong> Terbanyak dalam sejarah</li>
                <li><strong>Piala Dunia:</strong> Juara 2022</li>
                <li><strong>Copa América:</strong> Juara 2021</li>
                <li><strong>Barcelona:</strong> Top skor sepanjang masa klub</li>
                <li><strong>Julukan:</strong> La Pulga</li>
            </ul>

        </div>

    </div>

</body>
</html>
