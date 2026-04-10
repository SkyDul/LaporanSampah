<?php
// ========================================================
// ⚠️ KONFIGURASI DATABASE & S3 MENGGUNAKAN .ENV ⚠️
// ========================================================

// Fungsi sederhana untuk membaca file .env tanpa library tambahan
function loadEnv($path) {
    if(!file_exists($path)) {
        die("Error: File .env tidak ditemukan di folder src!");
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Abaikan komentar
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value, ' "\'');
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

// Muat variabel dari .env
loadEnv(__DIR__ . '/.env');

$is_local = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1']);

if ($is_local) {
    // KREDENSIAL LOCALHOST
    $dbHost = $_ENV['DB_LOCAL_HOST'] ?? 'localhost'; 
    $dbUser = $_ENV['DB_LOCAL_USER'] ?? 'root'; 
    $dbPass = $_ENV['DB_LOCAL_PASS'] ?? ''; 
    $dbName = $_ENV['DB_LOCAL_NAME'] ?? 'lapor_sampah_db';
} else {
    // KREDENSIAL RDS MYSQL (HOSTING)
    $dbHost = $_ENV['DB_RDS_HOST'] ?? '';
    $dbUser = $_ENV['DB_RDS_USER'] ?? '';
    $dbPass = $_ENV['DB_RDS_PASS'] ?? '';
    $dbName = $_ENV['DB_RDS_NAME'] ?? '';
}

// ========================================================
// ⚠️ KREDENSIAL S3 BUCKET ⚠️
// ========================================================
$bucketName   = $_ENV['S3_BUCKET_NAME'] ?? '';
$iamAccessKey = $_ENV['S3_IAM_ACCESS_KEY'] ?? '';
$iamSecretKey = $_ENV['S3_IAM_SECRET_KEY'] ?? '';
$region       = $_ENV['S3_REGION'] ?? '';

// Buat Koneksi Database (PDO)
try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>