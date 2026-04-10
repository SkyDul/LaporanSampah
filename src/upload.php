<?php
require 'config.php'; // Memuat kredensial dan deteksi $is_local

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];
    $file = $_FILES['foto'];

    $fileName = time() . '-' . basename($file['name']);
    $filePath = $file['tmp_name'];

    try {
        // ============================================
        // MENGGUNAKAN AWS S3 (Sesuai Kredensial Baru Anda)
        // ============================================
        require 'vendor/autoload.php';
        
        $s3 = new \Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => $region,
            'credentials' => [
                'key'    => $iamAccessKey,
                'secret' => $iamSecretKey,
            ]
        ]);

            $result = $s3->putObject([
                'Bucket' => $bucketName,
                'Key'    => $fileName,
                'SourceFile' => $filePath,
                // 'ACL'    => 'public-read'  <-- Hapus atau komentari baris ini
            ]);
            
            $fotoUrl = $result->get('ObjectURL');

        // Simpan Data ke Database (Bisa Local DB atau RDS)
        $stmt = $pdo->prepare("INSERT INTO laporan (lokasi, keterangan, foto_url) VALUES (?, ?, ?)");
        $stmt->execute([$lokasi, $keterangan, $fotoUrl]);

        // Jika sukses, redirect ke halaman monitoring dengan notifikasi
        header("Location: daftar_laporan.php?status=sukses");
        exit;

    } catch (Exception $e) {
        die("❌ Error Sistem: " . $e->getMessage());
    }
} else {
    echo "Akses ditolak.";
}
?>