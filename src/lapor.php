<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Sampah Liar - LaporSampahKu</title>
    <meta name="description" content="Form pelaporan sampah liar. Tandai lokasi di peta, unggah foto bukti, dan kirim laporan Anda.">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="lapor.php">Lapor Sampah</a></li>
                <li class="nav-item"><a class="nav-link" href="daftar_laporan.php">Monitoring</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="glass-card p-4 p-md-5 animate-in">
                <!-- Header -->
                <div class="text-center mb-4 pb-4 border-bottom">
                    <div class="icon-circle-lg mx-auto mb-3" style="background: var(--accent-glow);">
                        <i class="ph-bold ph-map-pin-line fs-2 text-accent"></i>
                    </div>
                    <h2 class="fw-bold mb-1" style="font-size: 1.4rem;">Form Pelaporan Sampah Liar</h2>
                    <p class="text-muted small mb-0">Laporkan penumpukan sampah liar di sekitar Anda agar segera ditindaklanjuti.</p>
                </div>

                <form action="upload.php" method="POST" enctype="multipart/form-data" id="reportForm">
                    <!-- Step 1: Map -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center gap-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:24px;height:24px;background:var(--accent);color:#fff;font-size:0.7rem;font-weight:800;">1</span>
                            Tandai Lokasi di Peta
                        </label>
                        <div class="map-container mb-3">
                            <div id="map" style="height: 320px;"></div>
                        </div>
                        
                        <label class="form-label fw-bold mt-3 d-flex align-items-center gap-2">
                            <i class="ph-fill ph-house-line" style="color: var(--info);"></i> Alamat Lengkap / Patokan
                        </label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control form-control-custom" required placeholder="Klik pada peta di atas atau ketik manual patokan...">
                        <small class="text-muted mt-1 d-block"><i class="ph ph-info"></i> Alamat akan otomatis terisi setelah memilih titik di peta.</small>
                    </div>

                    <!-- Step 2: Description -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center gap-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:24px;height:24px;background:var(--accent);color:#fff;font-size:0.7rem;font-weight:800;">2</span>
                            Keterangan Kondisi
                        </label>
                        <textarea name="keterangan" class="form-control form-control-custom" rows="4" required placeholder="Contoh: Sampah menumpuk, bau menyengat, dan menghalangi jalan..."></textarea>
                    </div>
                    
                    <!-- Step 3: Photo -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center gap-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:24px;height:24px;background:var(--accent);color:#fff;font-size:0.7rem;font-weight:800;">3</span>
                            Foto Bukti
                        </label>
                        <div class="upload-zone" id="uploadZone" onclick="document.getElementById('fotoInput').click()">
                            <input type="file" name="foto" id="fotoInput" accept="image/*" required style="display:none;">
                            <div id="uploadPlaceholder">
                                <i class="ph-bold ph-cloud-arrow-up fs-1 text-accent d-block mb-2"></i>
                                <span class="fw-bold d-block mb-1">Klik untuk upload foto</span>
                                <small class="text-muted">Format: JPG, PNG — Maks 5MB</small>
                            </div>
                            <div id="uploadPreview" style="display:none;">
                                <img id="previewImg" src="" alt="Preview" style="max-height:200px;border-radius:var(--radius-md);max-width:100%;">
                                <small class="text-muted d-block mt-2" id="fileName"></small>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 d-flex align-items-center justify-content-center gap-2 mt-4" id="submitBtn">
                        <i class="ph-bold ph-paper-plane-tilt"></i> Kirim Laporan
                    </button>
                </form>
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

<style>
    .upload-zone {
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-lg);
        padding: 40px 20px;
        text-align: center;
        background: rgba(255, 255, 255, 0.02);
        cursor: pointer;
        transition: all var(--transition-base);
    }
    .upload-zone:hover {
        border-color: var(--accent);
        background: var(--accent-glow);
    }
    .upload-zone.has-file {
        border-color: var(--accent);
        border-style: solid;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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

    // Inisialisasi Peta (Default ke center Indonesia atau disesuaikan)
    var map = L.map('map').setView([-6.897339, 107.635849], 14); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Custom Icon for marker to match premium feel
    var greenIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng, {icon: greenIcon}).addTo(map);
        }
        
        document.getElementById('lokasi').value = "⏳ Mengambil alamat...";

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    document.getElementById('lokasi').value = data.display_name;
                } else {
                    document.getElementById('lokasi').value = `📍 Koordinat: ${lat}, ${lng}`;
                }
            })
            .catch(error => {
                document.getElementById('lokasi').value = `📍 Koordinat: ${lat}, ${lng} (Gagal fetch jalan)`;
            });
    });

    // File upload preview
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const zone = document.getElementById('uploadZone');
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                previewImg.src = ev.target.result;
                placeholder.style.display = 'none';
                preview.style.display = 'block';
                fileName.textContent = file.name;
                zone.classList.add('has-file');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>