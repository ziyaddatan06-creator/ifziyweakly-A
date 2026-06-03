<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Data Pemain</title>
</head>
<body>

<h2>Tambah Data Pemain</h2>

<form action="" method="POST">
    Nama: <input type="text" name="nama" required><br><br>
    Gol: <input type="number" name="gol" required><br><br>
    Assist: <input type="number" name="assist" required><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>

<hr>

<?php
// Mengecek apakah tombol Simpan sudah diklik
if (isset($_POST['submit'])) {
    // Mengambil data dari input form menggunakan method POST
    $nama   = $_POST['nama'];
    $gol    = $_POST['gol'];
    $assist = $_POST['assist'];

    // Menampilkan data yang berhasil ditangkap (di sini kamu bisa menggantinya dengan query SQL ke database)
    echo "<h3>Data Pemain Berhasil Disimpan:</h3>";
    echo "Nama Pemain: " . htmlspecialchars($nama) . "<br>";
    echo "Jumlah Gol: " . htmlspecialchars($gol) . "<br>";
    echo "Jumlah Assist: " . htmlspecialchars($assist) . "<br>";
}
?>

</body>
</html>