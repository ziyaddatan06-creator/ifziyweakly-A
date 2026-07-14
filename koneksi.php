<?php
// Koneksi MySQL langsung untuk Laragon
// Pastikan database sudah dibuat di Laragon, misalnya: ifziyweekly
// SQL contoh:
// CREATE DATABASE IF NOT EXISTS ifziyweekly CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
// USE ifziyweekly;
// CREATE TABLE IF NOT EXISTS users (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(50) NOT NULL UNIQUE,
//   password VARCHAR(255) NOT NULL,
//   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );

$databaseHost = 'localhost';
$databaseUser = 'root';
$databasePass = 'root';
$databaseName = 'ifziyweekly';

$conn = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);
if ($conn->connect_error) {
    die('Koneksi database gagal: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
