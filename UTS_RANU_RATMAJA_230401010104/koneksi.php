<?php
// ============================================
// File: koneksi.php
// Deskripsi: Konfigurasi koneksi ke database MySQL
// ============================================

$host = "localhost";
$user = "root";
$pass = "";          // Sesuaikan dengan password MySQL Anda
$db   = "db_bukutamu";

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset ke UTF-8
$conn->set_charset("utf8mb4");
?>
