<?php
require_once 'koneksi.php';

$pesan = '';
$jenis_pesan = '';

// Proses submit form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = htmlspecialchars(trim($_POST['nama']));
    $instansi = htmlspecialchars(trim($_POST['instansi']));
    $tujuan   = htmlspecialchars(trim($_POST['tujuan']));
    $tanggal  = date('Y-m-d');
    $waktu    = date('H:i:s');

    if (!empty($nama) && !empty($instansi) && !empty($tujuan)) {
        $stmt = $conn->prepare("INSERT INTO buku_tamu (nama, instansi, tujuan, tanggal, waktu) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nama, $instansi, $tujuan, $tanggal, $waktu);

        if ($stmt->execute()) {
            $pesan       = 'Data tamu berhasil disimpan!';
            $jenis_pesan = 'success';
        } else {
            $pesan       = 'Gagal menyimpan data: ' . $stmt->error;
            $jenis_pesan = 'danger';
        }
        $stmt->close();
    } else {
        $pesan       = 'Semua field wajib diisi!';
        $jenis_pesan = 'warning';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        /* FIX: Definisi .guestbook-container yang hilang */
        .guestbook-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 20px 20px 0 0 !important;
        }

        .card-header h2 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .card-body {
            padding: 35px;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-label i {
            margin-right: 6px;
            color: #667eea;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e3e6f0;
            padding: 12px 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 30px;
            font-weight: 600;
            width: 100%;
            color: white;
            font-size: 1rem;
            transition: opacity 0.3s, transform 0.2s;
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            color: white;
        }

        .datetime-display {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .btn-lihat {
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="guestbook-container">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-journal-bookmark-fill fs-1 mb-2 d-block"></i>
                <h2>Buku Tamu Digital</h2>
                <p class="mb-0">Selamat datang di Sekolah Kami. Silakan isi data kunjungan Anda.</p>
            </div>
            <div class="card-body">

                <!-- Alert Notifikasi -->
                <?php if ($pesan): ?>
                <div class="alert alert-<?php echo $jenis_pesan; ?> alert-dismissible fade show" role="alert">
                    <i class="bi bi-<?php echo $jenis_pesan === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'; ?> me-2"></i>
                    <?php echo $pesan; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <!-- Tampilan Tanggal & Waktu Otomatis -->
                <div class="datetime-display">
                    <i class="bi bi-calendar-event me-2"></i>
                    <span id="datetime">Memuat waktu...</span>
                </div>

                <!-- Form Input Tamu -->
                <form method="POST" action="" id="formTamu">
                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            <i class="bi bi-person-fill"></i>Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nama" name="nama"
                               placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="instansi" class="form-label">
                            <i class="bi bi-building-fill"></i>Instansi / Asal <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="instansi" name="instansi"
                               placeholder="Masukkan nama instansi atau asal" required>
                    </div>

                    <div class="mb-4">
                        <label for="tujuan" class="form-label">
                            <i class="bi bi-bullseye"></i>Tujuan Kedatangan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="tujuan" name="tujuan" rows="3"
                                  placeholder="Jelaskan tujuan kedatangan Anda..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-submit mb-3">
                        <i class="bi bi-send-fill me-2"></i>Simpan Data Tamu
                    </button>
                </form>

                <div class="text-center">
                    <a href="daftar_tamu.php" class="btn btn-success btn-lihat">
                        <i class="bi bi-list-ul me-2"></i>Lihat Daftar Tamu
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateDateTime() {
            const now = new Date();
            document.getElementById('datetime').textContent =
                now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }) + ' — ' +
                now.toLocaleTimeString('id-ID');
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>
