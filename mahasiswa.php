<?php
session_start();

if (!isset($_SESSION['daftar_mahasiswa'])) {
    $_SESSION['daftar_mahasiswa'] = [
        [
            'nim' => '12345678',
            'nama' => 'Andi Pratama',
            'jurusan' => 'Teknik Informatika',
            'email' => 'andi@example.com',
            'no_hp' => '081234567890',
            'foto' => 'images/profile-placeholder.svg'
        ],
        [
            'nim' => '87654321',
            'nama' => 'Siti Nurhaliza',
            'jurusan' => 'Manajemen',
            'email' => 'siti@example.com',
            'no_hp' => '082345678901',
            'foto' => 'images/profile-placeholder.svg'
        ],
        [
            'nim' => '11223344',
            'nama' => 'Budi Santoso',
            'jurusan' => 'Ekonomi',
            'email' => 'budi@example.com',
            'no_hp' => '083456789012',
            'foto' => 'images/profile-placeholder.svg'
        ]
    ];
}

$message = '';
$editIndex = null;
$nim = '';
$nama = '';
$jurusan = '';
$email = '';
$no_hp = '';
$foto = 'images/profile-placeholder.svg';
$mode = 'tambah';
$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';

if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}

if (isset($_GET['edit'])) {
    $editIndex = intval($_GET['edit']);
    if (isset($_SESSION['daftar_mahasiswa'][$editIndex])) {
        $mode = 'edit';
        $nim = $_SESSION['daftar_mahasiswa'][$editIndex]['nim'];
        $nama = $_SESSION['daftar_mahasiswa'][$editIndex]['nama'];
        $jurusan = $_SESSION['daftar_mahasiswa'][$editIndex]['jurusan'] ?? $_SESSION['daftar_mahasiswa'][$editIndex]['prodi'] ?? '';
        $email = $_SESSION['daftar_mahasiswa'][$editIndex]['email'] ?? '';
        $no_hp = $_SESSION['daftar_mahasiswa'][$editIndex]['no_hp'] ?? '';
        $foto = $_SESSION['daftar_mahasiswa'][$editIndex]['foto'] ?? 'images/profile-placeholder.svg';
    }
}

if (isset($_POST['simpan'])) {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);
    $email = trim($_POST['email']);
    $no_hp = trim($_POST['no_hp']);
    $foto = 'images/profile-placeholder.svg';

    if (isset($_FILES['foto_file']) && $_FILES['foto_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/images/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['foto_file']['name']);
        $targetPath = $uploadDir . $fileName;
        $relativePath = 'images/uploads/' . $fileName;

        if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $targetPath)) {
            $foto = $relativePath;
        }
    }

    if ($nim === '' || $nama === '' || $jurusan === '' || $email === '' || $no_hp === '') {
        $message = 'Semua field harus diisi.';
    } else {
        if (isset($_POST['index']) && $_POST['index'] !== '') {
            $index = intval($_POST['index']);
            if (isset($_SESSION['daftar_mahasiswa'][$index])) {
                $_SESSION['daftar_mahasiswa'][$index] = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'jurusan' => $jurusan,
                    'email' => $email,
                    'no_hp' => $no_hp,
                    'foto' => $foto
                ];
                $message = 'Data mahasiswa berhasil diperbarui.';
            }
        } else {
            $_SESSION['daftar_mahasiswa'][] = [
                'nim' => $nim,
                'nama' => $nama,
                'jurusan' => $jurusan,
                'email' => $email,
                'no_hp' => $no_hp,
                'foto' => $foto
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
    <style>
        .student-photo {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #d9d9d9;
        }
    </style>
</head>
<body>
    <h1>LIONEL MESSI</h1>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="contact.php">Contact</a>
        <a href="statistik.php">Statistik</a>
        <a href="mahasiswa.php" class="active">Mahasiswa</a>
        <?php if (!empty($_SESSION['logged_in'])) : ?>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else : ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>

    <div class="container">
        <h2 class="welcome-heading">Data Mahasiswa</h2>

        <?php if ($message !== '') : ?>
            <div class="message-box"><?php echo $message; ?></div>
        <?php endif; ?>

        <section class="form-section">
            <h3><?php echo $mode === 'edit' ? 'Edit Mahasiswa' : 'Tambah Mahasiswa'; ?></h3>
            <form action="mahasiswa.php" method="POST" enctype="multipart/form-data" class="student-form">
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
                    <label for="jurusan">Jurusan</label>
                    <input type="text" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($jurusan); ?>" placeholder="Masukkan jurusan" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Masukkan email" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($no_hp); ?>" placeholder="Masukkan nomor HP" required>
                </div>

                <div class="form-group">
                    <label for="foto_file">Foto Profil</label>
                    <input type="file" id="foto_file" name="foto_file" accept="image/*">
                    <small>Unggah foto langsung dari perangkat Anda.</small>
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
            
            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                <form action="mahasiswa.php" method="GET" style="display: flex; gap: 10px; width: 100%;">
                    <input type="text" name="search" placeholder="Cari nama, NIM, email, atau jurusan..." value="<?php echo htmlspecialchars($searchKeyword); ?>" style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;">
                    <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Cari</button>
                    <?php if ($searchKeyword) : ?>
                        <a href="mahasiswa.php" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 14px; display: flex; align-items: center;">Hapus Filter</a>
                    <?php endif; ?>
                </form>
            </div>
            
            <?php if ($searchKeyword) : ?>
                <p style="color: #666; margin-bottom: 15px;">Hasil pencarian untuk: <strong><?php echo htmlspecialchars($searchKeyword); ?></strong></p>
            <?php endif; ?>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Filter data berdasarkan keyword pencarian
                    $dataDisplay = $_SESSION['daftar_mahasiswa'];
                    $displayIndices = range(0, count($dataDisplay) - 1);
                    
                    if ($searchKeyword) {
                        $filtered = array_filter($dataDisplay, function($mahasiswa) use ($searchKeyword) {
                            return stripos($mahasiswa['nama'], $searchKeyword) !== false ||
                                   stripos($mahasiswa['nim'], $searchKeyword) !== false ||
                                   stripos($mahasiswa['email'] ?? '', $searchKeyword) !== false ||
                                   stripos($mahasiswa['jurusan'] ?? '', $searchKeyword) !== false;
                        }, ARRAY_FILTER_USE_BOTH);
                        $dataDisplay = $filtered;
                        $displayIndices = array_keys($filtered);
                    }
                    ?>
                    <?php if (count($dataDisplay) === 0) : ?>
                        <tr>
                            <td colspan="8"><?php echo $searchKeyword ? 'Tidak ada hasil pencarian.' : 'Data mahasiswa masih kosong.'; ?></td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($dataDisplay as $actualIndex => $mahasiswa) : ?>
                            <?php
                                $fotoMahasiswa = !empty($mahasiswa['foto']) ? $mahasiswa['foto'] : 'images/profile-placeholder.svg';
                                $jurusanMahasiswa = $mahasiswa['jurusan'] ?? $mahasiswa['prodi'] ?? '-';
                                $emailMahasiswa = $mahasiswa['email'] ?? '-';
                                $noHpMahasiswa = $mahasiswa['no_hp'] ?? '-';
                            ?>
                            <tr>
                                <td><?php echo array_search($actualIndex, $displayIndices) + 1; ?></td>
                                <td><img src="<?php echo htmlspecialchars($fotoMahasiswa); ?>" alt="Foto <?php echo htmlspecialchars($mahasiswa['nama']); ?>" class="student-photo"></td>
                                <td><?php echo htmlspecialchars($mahasiswa['nama']); ?></td>
                                <td><?php echo htmlspecialchars($mahasiswa['nim']); ?></td>
                                <td><?php echo htmlspecialchars($jurusanMahasiswa); ?></td>
                                <td><?php echo htmlspecialchars($emailMahasiswa); ?></td>
                                <td><?php echo htmlspecialchars($noHpMahasiswa); ?></td>
                                <td>
                                    <a href="mahasiswa.php?edit=<?php echo $actualIndex; ?>" class="btn btn-edit">Edit</a>
                                    <a href="mahasiswa.php?delete=<?php echo $actualIndex; ?>" class="btn btn-delete" onclick="return confirm('Hapus data mahasiswa ini?');">Hapus</a>
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
