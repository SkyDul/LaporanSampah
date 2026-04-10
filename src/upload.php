<?php
require 'vendor/autoload.php';
require 'config.php'; // Memuat kredensial dari config.php

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];
    $file = $_FILES['foto'];

    // Inisialisasi S3 Client
    $s3 = new S3Client([
        'version' => 'latest',
        'region'  => $region,
        'credentials' => [
            'key'    => $iamAccessKey,
            'secret' => $iamSecretKey,
        ]
    ]);

    $fileName = time() . '-' . basename($file['name']);
    $filePath = $file['tmp_name'];

    try {
        // Upload ke S3
        $result = $s3->putObject([
            'Bucket' => $bucketName,
            'Key'    => $fileName,
            'SourceFile' => $filePath,
            'ACL'    => 'public-read' 
        ]);
        
        $s3Url = $result->get('ObjectURL');

        // Simpan ke RDS
        $stmt = $pdo->prepare("INSERT INTO laporan (lokasi, keterangan, foto_url) VALUES (?, ?, ?)");
        $stmt->execute([$lokasi, $keterangan, $s3Url]);

        // Jika sukses, redirect ke halaman daftar laporan
        header("Location: daftar_laporan.php?status=sukses");
        exit;

    } catch (AwsException $e) {
        die("❌ Error Upload S3: " . $e->getMessage());
    } catch (\PDOException $e) {
        die("❌ Error Database RDS: " . $e->getMessage());
    }
} else {
    echo "Akses ditolak.";
}
?>