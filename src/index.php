<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporSampahKu - Beranda</title>
    <meta name="description" content="Laporkan tumpukan sampah liar di sekitar Anda. Bantu kami menjaga kelestarian lingkungan kota.">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Custom CSS -->
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
            <ul class="navbar-nav ms-auto fw-medium">
                <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="lapor.php">Lapor Sampah</a></li>
                <li class="nav-item"><a class="nav-link" href="daftar_laporan.php">Monitoring</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Hero Section -->
    <div class="hero-card text-center mb-5 animate-in">
        <p class="text-uppercase fw-bold mb-3" style="color: var(--accent); font-size: 0.8rem; letter-spacing: 3px;">
            <i class="ph-fill ph-recycle"></i> PLATFORM PELAPORAN SAMPAH
        </p>
        <h1 class="hero-title">Lingkungan Bersih,<br>Tanggung Jawab Bersama</h1>
        <p class="lead mb-4 fw-light">Bantu kami menjaga kelestarian kota dengan melaporkan tumpukan sampah liar di sekitar Anda.</p>
        <a href="lapor.php" class="btn btn-premium mt-2 d-inline-flex align-items-center gap-2">
            <i class="ph-bold ph-camera"></i> Lapor Sekarang
        </a>
    </div>

    <!-- Stats Row -->
    <div class="row g-3 mb-5 animate-in animate-delay-1">
        <div class="col-4">
            <div class="stat-card text-center">
                <div class="stat-number text-accent glow-text">24/7</div>
                <div class="stat-label mt-1">Monitoring</div>
            </div>
        </div>
        <div class="col-4">
            <div class="stat-card text-center">
                <div class="stat-number text-accent glow-text"><i class="ph-fill ph-lightning" style="font-size:1.8rem"></i></div>
                <div class="stat-label mt-1">Respon Cepat</div>
            </div>
        </div>
        <div class="col-4">
            <div class="stat-card text-center">
                <div class="stat-number text-accent glow-text"><i class="ph-fill ph-shield-check" style="font-size:1.8rem"></i></div>
                <div class="stat-label mt-1">Terverifikasi</div>
            </div>
        </div>
    </div>

    <!-- Jadwal Section -->
    <div class="row justify-content-center mb-5 animate-in animate-delay-2">
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                    <div class="icon-circle" style="background: var(--accent-glow);">
                        <i class="ph-bold ph-calendar-check fs-4 text-accent"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0" style="font-size: 1.15rem;">Jadwal Pengangkutan Rutin</h3>
                        <small class="text-muted">Jadwal layanan kebersihan mingguan</small>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush schedule-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-plant fs-4" style="color: var(--accent);"></i>
                            <strong>Senin & Kamis</strong>
                        </div>
                        <span class="badge badge-custom bg-success">Sampah Organik</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-trash fs-4" style="color: var(--warning);"></i>
                            <strong>Selasa & Jumat</strong>
                        </div>
                        <span class="badge badge-custom bg-warning">Non-Organik</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-warning-octagon fs-4" style="color: var(--danger);"></i>
                            <strong>Minggu</strong>
                        </div>
                        <span class="badge badge-custom bg-danger">Limbah B3 / Khusus</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="row justify-content-center mb-5 animate-in animate-delay-3">
        <div class="col-lg-10">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="font-size: 1.4rem;">Cara Melaporkan</h2>
                <span class="section-line mx-auto"></span>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="stat-card text-center p-4 h-100">
                        <div class="icon-circle-lg mx-auto mb-3" style="background: var(--accent-glow);">
                            <i class="ph-bold ph-map-pin-line fs-2 text-accent"></i>
                        </div>
                        <h6 class="fw-bold mb-2">1. Tandai Lokasi</h6>
                        <p class="text-muted small mb-0">Pilih titik lokasi sampah di peta interaktif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card text-center p-4 h-100">
                        <div class="icon-circle-lg mx-auto mb-3" style="background: rgba(59, 130, 246, 0.1);">
                            <i class="ph-bold ph-camera fs-2" style="color: #60a5fa;"></i>
                        </div>
                        <h6 class="fw-bold mb-2">2. Ambil Foto</h6>
                        <p class="text-muted small mb-0">Upload foto bukti kondisi lingkungan</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card text-center p-4 h-100">
                        <div class="icon-circle-lg mx-auto mb-3" style="background: rgba(245, 158, 11, 0.1);">
                            <i class="ph-bold ph-paper-plane-tilt fs-2" style="color: #fbbf24;"></i>
                        </div>
                        <h6 class="fw-bold mb-2">3. Kirim Laporan</h6>
                        <p class="text-muted small mb-0">Petugas segera memproses laporan Anda</p>
                    </div>
                </div>
            </div>
        </div>
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
</script>
</body>
</html>