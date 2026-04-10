<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporSampahKu - Beranda</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Animate.css for smooth entrance -->
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
            <ul class="navbar-nav ms-auto fw-medium">
                <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="lapor.php">Lapor Sampah</a></li>
                <li class="nav-item"><a class="nav-link" href="daftar_laporan.php">Monitoring Petugas</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 animate__animated animate__fadeInUp">
    <!-- Premium Hero Section -->
    <div class="hero-card text-center mb-5">
        <h1 class="hero-title">Lingkungan Bersih, Tanggung Jawab Bersama</h1>
        <p class="lead mb-4 fw-light text-white-50">Bantu kami menjaga kelestarian kota dengan melaporkan tumpukan sampah liar di sekitar Anda.</p>
        <a href="lapor.php" class="btn btn-premium mt-2 d-inline-flex align-items-center gap-2">
            Lapor Sekarang <i class="ph-bold ph-camera"></i>
        </a>
    </div>

    <!-- Dashboard Widget: Jadwal -->
    <div class="row justify-content-center animate__animated animate__fadeInUp animate__delay-1s mb-5">
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                    <div class="bg-success text-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow" style="width:50px; height:50px;">
                        <i class="ph-bold ph-calendar-check fs-4"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-success">Jadwal Pengangkutan Rutin</h3>
                </div>
                
                <ul class="list-group list-group-flush schedule-list">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-plant fs-4 text-success"></i>
                            <strong class="text-dark">Senin & Kamis</strong>
                        </div>
                        <span class="badge badge-custom bg-success text-white shadow-sm">Sampah Organik</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-trash fs-4 text-warning"></i>
                            <strong class="text-dark">Selasa & Jumat</strong>
                        </div>
                        <span class="badge badge-custom bg-warning text-dark shadow-sm">Non-Organik</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-warning-octagon fs-4 text-danger"></i>
                            <strong class="text-dark">Minggu</strong>
                        </div>
                        <span class="badge badge-custom bg-danger text-white shadow-sm">Limbah B3 / Khusus</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ph-fill ph-warning-octagon fs-4 text-danger"></i>
                            <strong class="text-dark">tes CI/CD</strong>
                        </div>
                        <span class="badge badge-custom bg-danger text-white shadow-sm">Percobaan pertamaa</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>