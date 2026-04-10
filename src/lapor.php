<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Sampah Liar - LaporSampahKu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="lapor.php">Lapor Sampah</a></li>
                <li class="nav-item"><a class="nav-link" href="daftar_laporan.php">Monitoring Petugas</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5 animate__animated animate__zoomIn">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="glass-card p-4 p-md-5">
                <div class="text-center mb-4 pb-3 border-bottom">
                    <div class="d-inline-flex bg-success text-white rounded-circle p-3 mb-3 shadow" style="width:60px; height:60px; align-items:center; justify-content:center;">
                        <i class="ph-bold ph-map-pin-line fs-3"></i>
                    </div>
                    <h2 class="fw-bold text-success mb-1">Form Pelaporan Sampah Liar</h2>
                    <p class="text-muted">Laporkan penumpukan sampah liar di sekitar Anda agar segera ditindaklanjuti.</p>
                </div>

                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 text-dark">
                            <i class="ph-fill ph-map-trifold text-primary fs-5"></i> Tandai Lokasi di Peta
                        </label>
                        <div class="map-container mb-3">
                            <div id="map" style="height: 350px;"></div>
                        </div>
                        
                        <label class="form-label fw-bold mt-3 d-flex align-items-center gap-2 text-dark">
                            <i class="ph-fill ph-house-line text-info fs-5"></i> Alamat Lengkap / Patokan
                        </label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control form-control-custom" required placeholder="Klik pada peta di atas atau ketik manual patokan...">
                        <small class="text-muted mt-1 d-block"><i class="ph ph-info"></i> Alamat akan otomatis terisi setelah memilih titik di peta.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 text-dark">
                            <i class="ph-fill ph-text-align-left text-warning fs-5"></i> Keterangan Kondisi
                        </label>
                        <textarea name="keterangan" class="form-control form-control-custom" rows="4" required placeholder="Contoh: Sampah menumpuk, bau menyengat, dan menghalangi jalan..."></textarea>
                    </div>
                    
                    <div class="mb-5">
                        <label class="form-label fw-bold d-flex align-items-center gap-2 text-dark">
                            <i class="ph-fill ph-camera text-danger fs-5"></i> Foto Bukti
                        </label>
                        <input type="file" name="foto" class="form-control form-control-custom p-3" accept="image/*" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 d-flex align-items-center justify-content-center gap-2 fs-5">
                        <i class="ph-bold ph-paper-plane-tilt"></i> Kirim Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
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
        
        // Add a gentle bounce animation class simply by manipulating DOM if needed, but standard is fine
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
</script>
</body>
</html>