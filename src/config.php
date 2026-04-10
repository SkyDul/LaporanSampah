<?php
// ========================================================
// ⚠️ KONFIGURASI DATABASE (AUTO-SWITCH LOCAL / RDS) ⚠️
// ========================================================

$is_local = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1']);

if ($is_local) {
    // KREDENSIAL LOCALHOST (XAMPP/LARAGON)
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = 'tarikolot'; // Kosongkan jika pakai default Laragon/XAMPP
    $dbName = 'lapor_sampah_db';
} else {
    // KREDENSIAL RDS MYSQL (HOSTING / PRODUCTION)
    $dbHost = 'ENDPOINT_RDS_KAMU.rds.amazonaws.com';
    $dbUser = 'admin';
    $dbPass = 'password_database_kamu';
    $dbName = 'lapor_sampah_db';
}

// ========================================================
// ⚠️ KREDENSIAL S3 BUCKET ⚠️
// ========================================================
$bucketName = 'NAMA_BUCKET_S3_KAMU';
$iamAccessKey = 'ACCESS_KEY_IAM_KAMU';
$iamSecretKey = 'SECRET_KEY_IAM_KAMU';
$region = 'ap-southeast-1'; // Misal: ap-southeast-1

// Buat Koneksi Database (PDO)
try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>