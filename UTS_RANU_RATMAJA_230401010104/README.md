# 📚 Buku Tamu Digital Sekolah

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

Aplikasi web sederhana untuk mencatat data kunjungan tamu ke sekolah menggunakan PHP, MySQL, dan Bootstrap 5.

Dibuat sebagai tugas UTS Pemrograman Web.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 📝 Formulir Tamu | Input data tamu dengan tampilan modern dan responsif |
| ✅ Validasi Form | Validasi client-side dan server-side |
| 🕐 Tanggal & Waktu Otomatis | Terisi otomatis saat submit form |
| 📋 Daftar Tamu | Tabel dengan styling Bootstrap (striped, hover) |
| 🔍 Pencarian | Cari berdasarkan nama atau instansi |
| 📊 Statistik | Total tamu dan tamu hari ini |
| 📱 Responsive | Tampilan optimal di desktop, tablet, dan mobile |
| 🔒 Keamanan | Prepared Statements + htmlspecialchars() |

---

## 📁 Struktur File

```
buku_tamu_digital/
│
├── index.php           # Halaman Formulir Tamu
├── daftar_tamu.php     # Halaman Daftar Tamu
├── koneksi.php         # Konfigurasi Koneksi Database
├── db_bukutamu.sql     # Struktur Database + Data Contoh
└── README.md           # Dokumentasi Proyek
```

---

## 🗄️ Struktur Database

### Tabel: `buku_tamu`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| id | INT(11) | AUTO_INCREMENT, PRIMARY KEY | ID unik |
| nama | VARCHAR(100) | NOT NULL | Nama lengkap tamu |
| instansi | VARCHAR(100) | NOT NULL | Instansi/asal tamu |
| tujuan | TEXT | NOT NULL | Tujuan kedatangan |
| tanggal | DATE | NOT NULL | Tanggal kedatangan |
| waktu | TIME | NOT NULL | Waktu kedatangan |

---

## 🚀 Cara Instalasi

### Persyaratan
- XAMPP / WAMP / MAMP (Apache + MySQL + PHP)
- PHP versi 7.4 atau lebih tinggi
- MySQL / MariaDB versi 5.7 atau lebih tinggi

### Langkah-langkah

**1. Letakkan file proyek**
```
Salin folder buku_tamu_digital ke dalam:
C:/xampp/htdocs/buku_tamu_digital/   (Windows XAMPP)
/var/www/html/buku_tamu_digital/     (Linux)
```

**2. Import database**
- Buka phpMyAdmin: `http://localhost/phpmyadmin`
- Klik tab **Import**
- Pilih file `db_bukutamu.sql`
- Klik **Go / Kirim**

**3. Sesuaikan koneksi** *(jika perlu)*

Buka `koneksi.php` dan sesuaikan:
```php
$host = "localhost";
$user = "root";      // Username MySQL Anda
$pass = "";          // Password MySQL Anda (kosong jika default XAMPP)
$db   = "db_bukutamu";
```

**4. Jalankan aplikasi**

Buka browser dan akses:
```
http://localhost/buku_tamu_digital/
```

---

## 🛡️ Keamanan

- **Prepared Statements** (mysqli) — mencegah SQL Injection
- **`htmlspecialchars()`** — mencegah XSS
- **Validasi form** — client-side (HTML5 required) + server-side (PHP)
- **Charset UTF-8** — mendukung karakter Unicode

---

## 🛠️ Teknologi

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| PHP | 7.4+ | Backend & Logic |
| MySQL | 5.7+ | Database |
| Bootstrap | 5.3.8 | Frontend Framework |
| Bootstrap Icons | 1.11.3 | Icon Library |
| Google Fonts (Poppins) | — | Typography |

---

*Dibuat untuk keperluan UTS Pemrograman Web — Juni 2026*
