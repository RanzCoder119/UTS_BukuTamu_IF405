<?php
require_once 'koneksi.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query data tamu (dengan pencarian)
if ($search) {
    $search_param = "%$search%";
    $stmt = $conn->prepare("SELECT * FROM buku_tamu WHERE nama LIKE ? OR instansi LIKE ? ORDER BY tanggal DESC, waktu DESC");
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM buku_tamu ORDER BY tanggal DESC, waktu DESC");
}

// Hitung total tamu (FIX: menggunakan prepared statement)
$total_result = $conn->query("SELECT COUNT(*) as total FROM buku_tamu");
$total_row    = $total_result->fetch_assoc();
$total_tamu   = $total_row['total'];

// Hitung tamu hari ini (FIX: menggunakan prepared statement)
$today = date('Y-m-d');
$stmt_today = $conn->prepare("SELECT COUNT(*) as total FROM buku_tamu WHERE tanggal = ?");
$stmt_today->bind_param("s", $today);
$stmt_today->execute();
$today_row     = $stmt_today->get_result()->fetch_assoc();
$tamu_hari_ini = $today_row['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu - Buku Tamu Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }

        /* FIX: Definisi .main-container yang hilang */
        .main-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            background: white;
            border-radius: 20px;
            padding: 25px 35px;
            margin-bottom: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .page-header h1 i {
            color: #667eea;
            margin-right: 10px;
        }

        .page-header p {
            color: #888;
            margin: 4px 0 0;
            font-size: 0.9rem;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .stats-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: #667eea;
        }

        .stats-card p {
            color: #888;
            margin: 5px 0 0;
            font-size: 0.9rem;
        }

        .stats-card.today h3 {
            color: #f5576c;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 14px 12px;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 12px;
        }

        .badge-date {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .badge-time {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .search-section {
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e3e6f0;
            padding: 10px 16px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-search {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            padding: 10px 20px;
        }

        .btn-reset {
            border-radius: 12px;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #aaa;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .btn-tambah {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="main-container">

        <!-- Header -->
        <div class="page-header">
            <div>
                <h1><i class="bi bi-journal-bookmark-fill"></i>Daftar Tamu</h1>
                <p>Kelola dan lihat data kunjungan tamu sekolah</p>
            </div>
            <a href="index.php" class="btn btn-primary btn-tambah">
                <i class="bi bi-plus-circle me-2"></i>Tambah Tamu Baru
            </a>
        </div>

        <!-- Statistik -->
        <div class="row mb-4 g-3">
            <div class="col-md-6">
                <div class="stats-card">
                    <h3><?php echo number_format($total_tamu); ?></h3>
                    <p><i class="bi bi-people-fill me-1"></i>Total Semua Tamu</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-card today">
                    <h3><?php echo number_format($tamu_hari_ini); ?></h3>
                    <p><i class="bi bi-calendar-check me-1"></i>Tamu Hari Ini</p>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Tamu -->
        <div class="table-container">

            <!-- Form Pencarian -->
            <div class="search-section">
                <form method="GET" action="" class="row g-2">
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="search"
                               placeholder="🔍 Cari berdasarkan nama atau instansi..."
                               value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-search w-100">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                    </div>
                    <div class="col-md-1">
                        <a href="daftar_tamu.php" class="btn btn-outline-secondary btn-reset w-100" title="Reset">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </form>
                <?php if ($search): ?>
                <small class="text-muted mt-2 d-block">
                    Menampilkan hasil pencarian untuk: <strong>"<?php echo htmlspecialchars($search); ?>"</strong>
                </small>
                <?php endif; ?>
            </div>

            <!-- Tabel -->
            <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:5%">No</th>
                            <th>Nama Lengkap</th>
                            <th>Instansi / Asal</th>
                            <th>Tujuan Kedatangan</th>
                            <th style="width:12%">Tanggal</th>
                            <th style="width:10%">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?php echo $no++; ?></td>
                            <td><i class="bi bi-person-circle text-primary me-2"></i><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><i class="bi bi-building text-secondary me-2"></i><?php echo htmlspecialchars($row['instansi']); ?></td>
                            <td><?php echo htmlspecialchars($row['tujuan']); ?></td>
                            <td><span class="badge-date"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></span></td>
                            <td><span class="badge-time"><?php echo substr($row['waktu'], 0, 5); ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox d-block"></i>
                <h5>Belum ada data tamu</h5>
                <p><?php echo $search ? 'Tidak ditemukan tamu dengan kata kunci tersebut.' : 'Silakan tambahkan data tamu baru.'; ?></p>
                <a href="index.php" class="btn btn-primary btn-tambah mt-2">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Tamu Baru
                </a>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- FIX: Bootstrap JS yang hilang -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
