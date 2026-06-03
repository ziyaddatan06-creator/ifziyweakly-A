<?php
// 1. Memulai session untuk menyimpan data statistik sementara di server
session_start();

// 2. Inisialisasi data awal (jika session belum ada, kita buatkan data default Messi)
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

// 3. Logika PHP untuk menangkap data ketika form disubmit
if (isset($_POST['tambah_data'])) {
    $nama   = $_POST['nama'];
    $gol    = $_POST['gol'];
    $assist = $_POST['assist'];
    $rating = $_POST['rating'];

    // Validasi sederhana agar tidak ada input kosong
    if (!empty($nama) && $gol !== '' && $assist !== '' && $rating !== '') {
        
        // Menghitung nomor urut otomatis berdasarkan jumlah data saat ini + 1
        $no_baru = count($_SESSION['data_pemain']) + 1;

        // Memasukkan data baru ke dalam array Session
        $_SESSION['data_pemain'][] = [
            "no" => $no_baru,
            "nama" => $nama,
            "gol" => $gol,
            "assist" => $assist,
            "rating" => $rating
        ];

        // Mencegah form submitting ulang saat page di-refresh (Post/Redirect/Get pattern)
        header("Location: mahasiswa.php");
        exit();
    }
}

// Fitur Tambahan (Opsional): Reset Data jika ingin mengosongkan tabel kembali ke semula
if (isset($_GET['reset'])) {
    unset($_SESSION['data_pemain']);
    header("Location: mahasiswa.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statistik Messi</title>
    <link rel="stylesheet" href="asset/css/statistik.css">
</head>

<body>

<h1>LIONEL MESSI</h1>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="contact.php">Contact</a>
    <a href="mahasiswa.php">Statistik</a>
</div>

<hr>

<h2>Statistik Pemain</h2>

<form action="" method="POST">
    <input type="text" name="nama" placeholder="Nama Pemain" required><br><br>
    <input type="number" name="gol" placeholder="Gol" required><br><br>
    <input type="number" name="assist" placeholder="Assist" required><br><br>
    <input type="number" name="rating" step="0.1" placeholder="Rating" required><br><br>

    <button type="submit" name="tambah_data">Tambah Data</button>
    <a href="mahasiswa.php?reset=1" style="margin-left: 10px; color: red; text-decoration: none; font-size: 0.9em;">Reset Tabel</a>
</form>

<br>

<table id="tabel" border="1" style="border-collapse: collapse; width: 60%; text-align: left;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
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
                <td><?php echo $pemain['rating']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>