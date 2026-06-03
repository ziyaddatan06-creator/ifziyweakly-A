<!DOCTYPE html>
<html lang="id"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Lionel Messi</title>
    
    <link rel="stylesheet" href="asset/css/index.css">
</head>

<body>

    <h1>LIONEL MESSI</h1>

    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td><a href="index.php">Home</a></td>
            <td><a href="profile.php">Profile</a></td>
            <td><a href="contact.php">Contact</a></td>
            <td><a href="mahasiswa.php">Statistik</a></td>
        </tr>
    </table>

    <div class="container">

        <figure>
            <img src="images/asset/messi1.jpg" width="500px" alt="Lionel Messi">
            <figcaption>Lionel Messi saat bermain untuk Barcelona</figcaption>
        </figure>

        <p>
            Lionel Andrés Messi adalah pemain sepak bola profesional asal Argentina 
            yang dikenal sebagai salah satu pemain terbaik sepanjang masa.
        </p>

        <h2>Daftar Prestasi</h2>

        <div class="club-name"><strong>Barcelona</strong></div>
        <ul>
            <li>La Liga: 9x</li>
            <li>Liga Champions: 4x</li>
        </ul>

        <div class="club-name"><strong>Tim Nasional Argentina</strong></div>
        <ul>
            <li>Piala Dunia: 2022</li>
            <li>Copa América: 2021</li>
        </ul>

        <hr>
        <footer>
            <a href="https://id.wikipedia.org/wiki/Lionel_Messi" target="_blank">Wikipedia Profile</a> |
            <a href="https://www.instagram.com/leomessi/" target="_blank">Instagram</a>
            <br><br>
            <p style="color: grey; font-size: 0.9em;">&copy; <?php echo date('Y'); ?> Lionel Messi Fans Page</p>
        </footer>

    </div>

</body>
</html>