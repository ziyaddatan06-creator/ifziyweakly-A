<?php
echo "========================================\n";
echo "Database Setup for ifZIY Weekly\n";
echo "========================================\n\n";

// Test berbagai konfigurasi
$configs = [
    ['host' => 'localhost', 'user' => 'root', 'pass' => '', 'name' => 'ifziyweekly'],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => '', 'name' => 'ifziyweekly'],
    ['host' => 'localhost', 'user' => 'root', 'pass' => 'root', 'name' => 'ifziyweekly'],
];

$connected = false;
$workingConfig = null;

foreach ($configs as $index => $config) {
    echo "Test #" . ($index + 1) . " : Connecting to {$config['host']} as {$config['user']}...\n";
    
    $conn = @new mysqli(
        $config['host'],
        $config['user'],
        $config['pass'],
        '',
        3306,
        null
    );
    
    if (!$conn->connect_error) {
        echo "✅ BERHASIL! \n";
        echo "   Host: {$config['host']}\n";
        echo "   User: {$config['user']}\n";
        echo "   Password: " . ($config['pass'] ? 'Yes' : 'No/Blank') . "\n\n";
        $connected = true;
        $workingConfig = $config;
        $conn->close();
        break;
    } else {
        echo "❌ Failed: {$conn->connect_error}\n\n";
    }
}

if ($connected) {
    echo "✅ Koneksi berhasil!\n\n";
    echo "Gunakan konfigurasi ini di koneksi.php:\n";
    echo "---------------------------------------\n";
    echo "\$databaseHost = '{$workingConfig['host']}';\n";
    echo "\$databaseUser = '{$workingConfig['user']}';\n";
    echo "\$databasePass = '{$workingConfig['pass']}';\n";
    echo "\$databaseName = '{$workingConfig['name']}';\n";
    echo "---------------------------------------\n\n";
    
    // Coba buat database
    $conn = new mysqli(
        $workingConfig['host'],
        $workingConfig['user'],
        $workingConfig['pass']
    );
    
    echo "Membuat database 'ifziyweekly'...\n";
    if ($conn->query("CREATE DATABASE IF NOT EXISTS ifziyweekly CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
        echo "✅ Database created/exists\n\n";
    }
    
    $conn->close();
} else {
    echo "❌ GAGAL KONEKSI KE MYSQL\n\n";
    echo "Solusi:\n";
    echo "1. Buka Laragon GUI\n";
    echo "2. Klik tombol START atau pastikan MySQL service running\n";
    echo "3. Cek di C:\\laragon\\etc\\my.ini untuk konfigurasi MySQL\n";
    echo "4. Atau coba jalankan: D:\\laragon\\bin\\mysql\\mysql-8.0.35-win64\\bin\\mysql -u root\n";
}
?>
