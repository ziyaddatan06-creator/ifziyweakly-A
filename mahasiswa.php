<?php
session_start();

if (!isset($_SESSION['daftar_mahasiswa'])) {
    $_SESSION['daftar_mahasiswa'] = [
        [
            'nim' => '12345678',
            'nama' => 'Andi Pratama',
            'prodi' => 'Teknik Informatika'
        ],
        [
            'nim' => '87654321',
            'nama' => 'Siti Nurhaliza',
            'prodi' => 'Manajemen'
        ],
        [
            'nim' => '11223344',
            'nama' => 'Budi Santoso',
            'prodi' => 'Ekonomi'
        ]
    ];
}

$message = '';
$editIndex = null;
$nim = '';
$nama = '';
$prodi = '';
$mode = 'tambah';

if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}

if (isset($_GET['edit'])) {
    $editIndex = intval($_GET['edit']);
    if (isset($_SESSION['daftar_mahasiswa'][$editIndex])) {
        $mode = 'edit';
        $nim = $_SESSION['daftar_mahasiswa'][$editIndex]['nim'];
        $nama = $_SESSION['daftar_mahasiswa'][$editIndex]['nama'];
        $prodi = $_SESSION['daftar_mahasiswa'][$editIndex]['prodi'];
    }
}

if (isset($_POST['simpan'])) {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $prodi = trim($_POST['prodi']);

    if ($nim === '' || $nama === '' || $prodi === '') {
        $message = 'Semua field harus diisi.';
    } else {
        if (isset($_POST['index']) && $_POST['index'] !== '') {
            $index = intval($_POST['index']);
            if (isset($_SESSION['daftar_mahasiswa'][$index])) {
                $_SESSION['daftar_mahasiswa'][$index] = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'prodi' => $prodi
                ];
                $message = 'Data mahasiswa berhasil diperbarui.';
            }
        } else {
            $_SESSION['daftar_mahasiswa'][] = [
                'nim' => $nim,
                'nama' => $nama,
                'prodi' => $prodi
            ];
            $message = 'Mahasiswa baru berhasil ditambahkan.';
        }

        header('Location: mahasiswa.php?msg=' . urlencode($message));
        exit;
    }
}

if (isset($_GET['delete'])) {
    $deleteIndex = intval($_GET['delete']);
    if (isset($_SESSION['daftar_mahasiswa'][$deleteIndex])) {
        array_splice($_SESSION['daftar_mahasiswa'], $deleteIndex, 1);
        $message = 'Data mahasiswa berhasil dihapus.';
    }
    header('Location: mahasiswa.php?msg=' . urlencode($message));
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa | Lionel Messi</title>
    <link rel="stylesheet" href="asset/css/home.css">
</head>
<body>
    <h1>LIONEL MESSI</h1>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="contact.php">Contact</a>
        <a href="statistik.php">Statistik</a>
        <a href="mahasiswa.php" class="active">Mahasiswa</a>
    </div>

    <div class="container">
        <h2 class="welcome-heading">Data Mahasiswa</h2>

        <?php if ($message !== '') : ?>
            <div class="message-box"><?php echo $message; ?></div>
        <?php endif; ?>

        <section class="form-section">
            <h3><?php echo $mode === 'edit' ? 'Edit Mahasiswa' : 'Tambah Mahasiswa'; ?></h3>
            <form action="mahasiswa.php" method="POST" class="student-form">
                <input type="hidden" name="index" value="<?php echo $mode === 'edit' ? $editIndex : ''; ?>">

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" value="<?php echo htmlspecialchars($nim); ?>" placeholder="Masukkan NIM" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" placeholder="Masukkan nama mahasiswa" required>
                </div>

                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <input type="text" id="prodi" name="prodi" value="<?php echo htmlspecialchars($prodi); ?>" placeholder="Masukkan program studi" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-primary"><?php echo $mode === 'edit' ? 'Simpan Perubahan' : 'Tambah Mahasiswa'; ?></button>
                    <?php if ($mode === 'edit') : ?>
                        <a href="mahasiswa.php" class="btn btn-secondary">Batal</a>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <section class="student-table-section">
            <h3>Daftar Mahasiswa</h3>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($_SESSION['daftar_mahasiswa']) === 0) : ?>
                        <tr>
                            <td colspan="5">Data mahasiswa masih kosong.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($_SESSION['daftar_mahasiswa'] as $index => $mahasiswa) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($mahasiswa['nim']); ?></td>
                                <td><?php echo htmlspecialchars($mahasiswa['nama']); ?></td>
                                <td><?php echo htmlspecialchars($mahasiswa['prodi']); ?></td>
                                <td>
                                    <a href="mahasiswa.php?edit=<?php echo $index; ?>" class="btn btn-edit">Edit</a>
                                    <a href="mahasiswa.php?delete=<?php echo $index; ?>" class="btn btn-delete" onclick="return confirm('Hapus data mahasiswa ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Fans Lionel Messi Indonesia</p>
    </footer>
</body>
</html>
