<?php
session_start();

if (!isset($_SESSION['data_pemain'])) {
    $_SESSION['data_pemain'] = [
        [
            "no" => 1,
            "nama" => "Messi",
            "gol" => 30,
            "assist" => 20,
            "rating" => 9.5
        ]
    ];
}

if (isset($_POST['tambah_data'])) {
    $nama   = $_POST['nama'];
    $gol    = $_POST['gol'];
    $assist = $_POST['assist'];
    $rating = $_POST['rating'];

    if (!empty($nama) && $gol !== '' && $assist !== '' && $rating !== '') {
        $no_baru = count($_SESSION['data_pemain']) + 1;
        $_SESSION['data_pemain'][] = [
            "no" => $no_baru,
            "nama" => $nama,
            "gol" => $gol,
            "assist" => $assist,
            "rating" => $rating
        ];
        header("Location: statistik.php");
        exit();
    }
}

if (isset($_GET['reset'])) {
    unset($_SESSION['data_pemain']);
    header("Location: statistik.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik | Lionel Messi</title>
    <link rel="stylesheet" href="asset/css/statistik.css">
</head>

<body>

<div class="container">
    <header class="site-header">
        <h1 class="site-title">LIONEL MESSI</h1>

        <nav class="site-nav">
            <a href="index.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="contact.php">Contact</a>
            <a href="statistik.php" class="active">Statistik</a>
            <a href="mahasiswa.php">Mahasiswa</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <main>
        <section class="stats-section">
            <form class="stats-form" action="statistik.php" method="POST">
                <div class="form-group">
                    <input type="text" name="nama" placeholder="Nama Pemain" required>
                </div>
                <div class="form-group">
                    <input type="number" name="gol" placeholder="Gol" required>
                </div>
                <div class="form-group">
                    <input type="number" name="assist" placeholder="Assist" required>
                </div>
                <div class="form-group">
                    <input type="number" name="rating" step="0.1" placeholder="Rating" required>
                </div>
                <div class="form-actions">
                    <button type="submit" name="tambah_data" class="btn btn-primary">➕ Tambah Data</button>
                    <a href="statistik.php?reset=1" class="btn btn-danger">🔄 Reset Tabel</a>
                </div>
            </form>
        </section>

        <section class="table-section">
        <h2 class="section-title">📋 Daftar Statistik</h2>
        <div class="table-wrapper">
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemain</th>
                        <th>Gol</th>
                        <th>Assist</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['data_pemain'] as $pemain) : ?>
                        <tr>
                            <td><?php echo $pemain['no']; ?></td>
                            <td><?php echo htmlspecialchars($pemain['nama']); ?></td>
                            <td><?php echo $pemain['gol']; ?></td>
                            <td><?php echo $pemain['assist']; ?></td>
                            <td>
                                <span class="rating-badge"><?php echo $pemain['rating']; ?>/10</span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

    <footer class="site-footer">
        <p>&copy; <?php echo date('Y'); ?> Lionel Messi Fans Page | All Rights Reserved</p>
    </footer>
</div>

</body>
</html>
