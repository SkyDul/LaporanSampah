<?php
session_start();

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] === 'petugas' && $_POST['password'] === 'petugas') {
        $_SESSION['is_logged_in'] = true;
        header("Location: daftar_laporan.php");
        exit;
    } else {
        $error_msg = "Username atau Password yang Anda masukkan salah!";
    }
}

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: daftar_laporan.php");
    exit;
}

// -------------------------------------------------------------
// JIKA BELUM LOGIN: TAMPILKAN FORM LOGIN
// -------------------------------------------------------------
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true): ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas - LaporSampahKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 0;">

<div class="container animate__animated animate__zoomIn">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="glass-card p-5 text-center">
                <div class="d-inline-flex bg-success bg-opacity-10 text-success rounded-circle p-3 mb-4 shadow-sm" style="width:80px; height:80px; align-items:center; justify-content:center;">
                    <i class="ph-fill ph-user-circle fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2">Akses Petugas</h3>
                <p class="text-muted mb-4">Silakan masukkan username dan password untuk login.</p>
                
                <?php if (isset($error_msg)): ?>
                    <div class="alert alert-danger py-2 small d-flex align-items-center justify-content-center gap-2">
                        <i class="ph-bold ph-warning-circle"></i> <?= $error_msg ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="daftar_laporan.php">
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 text-dark">
                            <i class="ph-fill ph-user text-primary"></i> Username
                        </label>
                        <input type="text" name="username" class="form-control form-control-custom text-center fs-5" required placeholder="petugas">
                    </div>
                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 text-dark">
                            <i class="ph-fill ph-key text-primary"></i> Password
                        </label>
                        <input type="password" name="password" class="form-control form-control-custom text-center fs-5" required placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2 py-2 fs-5">
                        <i class="ph-bold ph-sign-in"></i> Masuk
                    </button>
                    
                    <div class="mt-4">
                        <a href="index.php" class="text-decoration-none text-success fw-bold d-inline-flex align-items-center gap-1">
                            <i class="ph-bold ph-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php 
exit; // Hentikan script jika belum login
endif; 
// -------------------------------------------------------------
// JIKA SUDAH LOGIN: TAMPILKAN DASHBOARD MONITORING
// -------------------------------------------------------------

require 'config.php';

// Ambil data dari tabel laporan
$stmt = $pdo->query("SELECT * FROM laporan ORDER BY tanggal DESC");
$laporan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getStatusBadge() {
    $statuses = [
        ['label' => 'Menunggu', 'color' => 'warning', 'icon' => 'ph-clock'],
        ['label' => 'Proses', 'color' => 'info', 'icon' => 'ph-spinner-gap'],
        ['label' => 'Selesai', 'color' => 'success', 'icon' => 'ph-check-circle']
    ];
    return $statuses[array_rand($statuses)];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Petugas - LaporSampahKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-glass">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <i class="ph-fill ph-leaf text-success fs-3"></i> 
            LaporSampahKu
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="ph ph-list fs-1 text-dark"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-medium align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="lapor.php">Lapor Sampah</a></li>
                <li class="nav-item"><a class="nav-link active" href="daftar_laporan.php">Monitoring Petugas</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-sm btn-outline-danger shadow-sm rounded-pill px-3 d-inline-flex align-items-center gap-1" href="daftar_laporan.php?logout=true" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                        <i class="ph-bold ph-sign-out"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5 animate__animated animate__fadeIn">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 border-bottom pb-3">
        <div>
            <h2 class="fw-bold text-success mb-1 d-flex align-items-center gap-2">
                <i class="ph-fill ph-monitor-play fs-2"></i> Monitoring Laporan Masuk
            </h2>
            <p class="text-muted mb-0">Pantau pergerakan dan status pengangkutan oleh petugas kebersihan secara real-time.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2 align-items-center">
            <span class="badge bg-success bg-opacity-10 text-success border border-success p-2 rounded-pill shadow-sm d-flex align-items-center gap-1">
                <i class="ph-bold ph-broadcast"></i> Live Updates
            </span>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary p-2 rounded-pill shadow-sm d-flex align-items-center gap-1">
                <i class="ph-bold ph-user"></i> Petugas
            </span>
        </div>
    </div>
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center gap-2" role="alert">
            <i class="ph-fill ph-check-circle fs-4"></i>
            <div>
                <strong>Berhasil!</strong> Laporan dan foto berhasil disimpan dan sedang di-review oleh sistem.
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (count($laporan_list) > 0): ?>
            <?php foreach ($laporan_list as $index => $row): 
                $status = getStatusBadge();
                $delay = ($index % 4) * 0.1;
            ?>
                <div class="col-sm-6 col-lg-4 animate__animated animate__zoomIn" style="animation-delay: <?= $delay ?>s">
                    <div class="glass-card h-100 p-0 position-relative">
                        <!-- Status Badge -->
                        <div class="status-badge text-<?= $status['color'] ?> d-flex align-items-center gap-1">
                            <i class="ph-bold <?= $status['icon'] ?>"></i> <?= $status['label'] ?>
                        </div>
                        
                        <div class="img-wrapper">
                            <img src="<?= htmlspecialchars($row['foto_url']) ?>" class="w-100 report-img" alt="Foto Bukti" onerror="this.src='https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=400';">
                        </div>
                        
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark d-flex align-items-start gap-2 mb-3" style="line-height: 1.4; font-size: 1.1rem;">
                                <i class="ph-fill ph-map-pin text-danger mt-1"></i> 
                                <span><?= htmlspecialchars($row['lokasi']) ?></span>
                            </h5>
                            
                            <div class="d-flex align-items-center gap-2 mb-3 text-muted small bg-light p-2 rounded">
                                <i class="ph-bold ph-calendar-blank text-primary"></i>
                                <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?>
                            </div>
                            
                            <div class="d-flex align-items-start gap-2 text-muted">
                                <i class="ph-bold ph-quotes text-secondary mt-1"></i>
                                <span class="fst-italic">"<?= htmlspecialchars($row['keterangan']) ?>"</span>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent border-top-0 p-4 pt-0">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= urlencode($row['lokasi']) ?>" target="_blank" class="btn btn-outline-success w-100 rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="ph-bold ph-navigation-arrow"></i> Rute Petugas
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 animate__animated animate__fadeIn">
                <div class="empty-state shadow-sm">
                    <i class="ph-fill ph-leaf d-block mx-auto mb-3" style="font-size: 5rem; color: rgba(255,255,255,0.8);"></i>
                    <h3 class="fw-bold">Belum ada laporan sampah liar.</h3>
                    <p class="mb-0 text-white-50">Lingkungan bersih adalah tanggung jawab kita semua! 🌿</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>