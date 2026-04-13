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
    <meta name="description" content="Halaman login petugas LaporSampahKu untuk monitoring laporan sampah.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 0;">

<!-- Background Grid -->
<div class="bg-grid"></div>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-lg-4 mx-auto">
            <div class="glass-card p-4 p-md-5 text-center animate-in">
                <!-- Logo -->
                <a href="index.php" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-4" style="color: var(--text-primary); font-weight: 800; font-size: 1.2rem;">
                    <i class="ph-fill ph-leaf fs-3 text-accent"></i>
                    LaporSampahKu
                </a>

                <div class="icon-circle-lg mx-auto mb-3" style="background: var(--accent-glow);">
                    <i class="ph-fill ph-user-circle fs-1 text-accent"></i>
                </div>
                <h3 class="fw-bold mb-1" style="font-size: 1.25rem;">Akses Petugas</h3>
                <p class="text-muted small mb-4">Masukkan kredensial untuk mengakses dashboard monitoring.</p>
                
                <?php if (isset($error_msg)): ?>
                    <div class="alert alert-danger py-2 small d-flex align-items-center justify-content-center gap-2 mb-3">
                        <i class="ph-bold ph-warning-circle"></i> <?= $error_msg ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="daftar_laporan.php">
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 small">
                            <i class="ph-fill ph-user" style="color: var(--info);"></i> Username
                        </label>
                        <input type="text" name="username" class="form-control form-control-custom" required placeholder="Masukkan username" autocomplete="username">
                    </div>
                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 small">
                            <i class="ph-fill ph-key" style="color: var(--info);"></i> Password
                        </label>
                        <input type="password" name="password" class="form-control form-control-custom" required placeholder="••••••••" autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 d-flex align-items-center justify-content-center gap-2 py-3">
                        <i class="ph-bold ph-sign-in"></i> Masuk
                    </button>
                    
                    <div class="mt-4">
                        <a href="index.php" class="text-decoration-none text-accent fw-bold d-inline-flex align-items-center gap-1 small">
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
    <meta name="description" content="Dashboard monitoring laporan sampah untuk petugas kebersihan.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Background Grid -->
<div class="bg-grid"></div>

<nav class="navbar navbar-expand-lg fixed-top navbar-glass" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <i class="ph-fill ph-leaf fs-3"></i>
            LaporSampahKu
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="ph ph-list fs-2"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-medium align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="lapor.php">Lapor Sampah</a></li>
                <li class="nav-item"><a class="nav-link active" href="daftar_laporan.php">Monitoring</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-sm btn-outline-danger rounded-pill px-3 d-inline-flex align-items-center gap-1" href="daftar_laporan.php?logout=true" id="logoutBtn">
                        <i class="ph-bold ph-sign-out"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Dashboard Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-3 border-bottom animate-in">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="pulse-dot"></span>
                <small class="text-accent fw-bold" style="letter-spacing: 1px; font-size: 0.75rem;">LIVE DASHBOARD</small>
            </div>
            <h2 class="fw-bold mb-1" style="font-size: 1.5rem;">
                Monitoring Laporan
            </h2>
            <p class="text-muted mb-0 small">Pantau pergerakan dan status pengangkutan oleh petugas kebersihan.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2 align-items-center">
            <span class="badge bg-success border border-success p-2 rounded-pill d-flex align-items-center gap-1">
                <i class="ph-bold ph-broadcast"></i> <?= count($laporan_list) ?> Laporan
            </span>
            <span class="badge bg-primary border border-primary p-2 rounded-pill d-flex align-items-center gap-1">
                <i class="ph-bold ph-user"></i> Petugas
            </span>
        </div>
    </div>
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4 animate-in" role="alert">
            <i class="ph-fill ph-check-circle fs-4"></i>
            <div>
                <strong>Berhasil!</strong> Laporan dan foto berhasil disimpan dan sedang di-review oleh sistem.
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (count($laporan_list) > 0): ?>
            <?php foreach ($laporan_list as $index => $row): 
                $status = getStatusBadge();
                $delay = ($index % 6) * 0.08;
            ?>
                <div class="col-sm-6 col-lg-4 animate-in" style="animation-delay: <?= $delay ?>s">
                    <div class="glass-card h-100 p-0 position-relative">
                        <!-- Status Badge -->
                        <div class="status-badge text-<?= $status['color'] ?> d-flex align-items-center gap-1">
                            <i class="ph-bold <?= $status['icon'] ?>"></i> <?= $status['label'] ?>
                        </div>
                        
                        <div class="img-wrapper">
                            <img src="<?= htmlspecialchars($row['foto_url']) ?>" class="w-100 report-img" alt="Foto Bukti" onerror="this.src='https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=400';" loading="lazy">
                        </div>
                        
                        <div class="card-body p-4">
                            <h5 class="fw-bold d-flex align-items-start gap-2 mb-3" style="line-height: 1.4; font-size: 0.95rem;">
                                <i class="ph-fill ph-map-pin mt-1" style="color: var(--danger); flex-shrink:0;"></i> 
                                <span><?= htmlspecialchars($row['lokasi']) ?></span>
                            </h5>
                            
                            <div class="d-flex align-items-center gap-2 mb-3 small p-2 rounded" style="background: rgba(255,255,255,0.03);">
                                <i class="ph-bold ph-calendar-blank" style="color: var(--info);"></i>
                                <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?>
                            </div>
                            
                            <div class="d-flex align-items-start gap-2">
                                <i class="ph-bold ph-quotes mt-1" style="color: var(--text-muted);"></i>
                                <span class="fst-italic small">"<?= htmlspecialchars($row['keterangan']) ?>"</span>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent p-4 pt-0">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= urlencode($row['lokasi']) ?>" target="_blank" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="ph-bold ph-navigation-arrow"></i> Rute Petugas
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 animate-in">
                <div class="empty-state">
                    <i class="ph-fill ph-leaf d-block mx-auto mb-3" style="font-size: 4rem; color: var(--accent); opacity: 0.5;"></i>
                    <h3 class="fw-bold mb-2" style="font-size: 1.2rem;">Belum ada laporan sampah liar.</h3>
                    <p class="mb-0 small">Lingkungan bersih adalah tanggung jawab kita semua! 🌿</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="container text-center">
        <p class="d-flex align-items-center justify-content-center gap-2">
            <i class="ph-fill ph-leaf" style="color: var(--accent);"></i>
            © 2026 LaporSampahKu — Jaga Lingkungan, Mulai Dari Kita
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 30) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // Custom logout confirmation
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        if (!confirm('Apakah Anda yakin ingin keluar?')) {
            e.preventDefault();
        }
    });
</script>
</body>
</html>