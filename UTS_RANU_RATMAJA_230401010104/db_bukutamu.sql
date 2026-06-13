-- ============================================
-- Database: db_bukutamu
-- Proyek   : Buku Tamu Digital Sekolah
-- Matkul   : Pemrograman Web
-- ============================================

CREATE DATABASE IF NOT EXISTS db_bukutamu
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE db_bukutamu;

-- ============================================
-- Tabel: buku_tamu
-- ============================================
CREATE TABLE IF NOT EXISTS buku_tamu (
    id       INT(11)      NOT NULL AUTO_INCREMENT,
    nama     VARCHAR(100) NOT NULL,
    instansi VARCHAR(100) NOT NULL,
    tujuan   TEXT         NOT NULL,
    tanggal  DATE         NOT NULL,
    waktu    TIME         NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Data Contoh (10 records)
-- ============================================
INSERT INTO buku_tamu (nama, instansi, tujuan, tanggal, waktu) VALUES
('Ahmad Rizky',      'Dinas Pendidikan Kota',    'Koordinasi program literasi digital',          '2026-06-08', '08:30:00'),
('Siti Nurhaliza',   'Universitas Indonesia',    'Penelitian metode pembelajaran hybrid',        '2026-06-08', '09:15:00'),
('Budi Santoso',     'PT. Teknologi Nusantara',  'Presentasi kerja sama program magang',         '2026-06-08', '10:00:00'),
('Dewi Kusuma',      'Kementerian Pendidikan',   'Monitoring kurikulum merdeka',                 '2026-06-07', '13:45:00'),
('Eko Prasetyo',     'SMAN 5 Jakarta',           'Studi banding manajemen sekolah',              '2026-06-07', '14:30:00'),
('Fitriani Rahma',   'Perpustakaan Nasional',    'Donasi buku perpustakaan',                     '2026-06-06', '09:00:00'),
('Guntur Wibowo',    'Komite Sekolah',           'Rapat koordinasi tahun ajaran baru',           '2026-06-06', '10:30:00'),
('Hani Suryani',     'Lembaga Sertifikasi',      'Sosialisasi sertifikasi kompetensi guru',      '2026-06-05', '08:00:00'),
('Indra Kurniawan',  'Bank Indonesia',           'Edukasi literasi keuangan untuk siswa',        '2026-06-05', '11:00:00'),
('Joko Susilo',      'Orang Tua Murid',          'Konsultasi perkembangan akademik anak',        '2026-06-04', '15:30:00');
