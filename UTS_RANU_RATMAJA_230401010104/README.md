# 📚 Buku Tamu Digital Sekolah

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)

Aplikasi web sederhana untuk mencatat data kunjungan tamu ke sekolah menggunakan PHP, MySQL, dan Bootstrap 5.

**Mata Kuliah:** Pemrograman Web II | **Kelas:** IF405 | **NIM:** 230401010104

---

## 📸 Preview Tampilan

### Halaman Formulir Tamu
![Form Tamu](https://raw.githubusercontent.com/RanzCoder119/MK_PemrogramanWeb-II_2026/main/UTS_RANU_RATMAJA_230401010104/screenshot_form.png)

### Halaman Daftar Tamu
![Daftar Tamu](https://raw.githubusercontent.com/RanzCoder119/MK_PemrogramanWeb-II_2026/main/UTS_RANU_RATMAJA_230401010104/screenshot_daftar.png)

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
UTS_RANU_RATMAJA_230401010104/
├── index.php              # Halaman Formulir Tamu
├── daftar_tamu.php        # Halaman Daftar Tamu
├── koneksi.php            # Konfigurasi Koneksi Database
├── db_bukutamu.sql        # Struktur Database + Data Contoh
├── screenshot_form.png    # Preview Form
├── screenshot_daftar.png  # Preview Tabel
└── README.md              # Dokumentasi Proyek
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

1. Copy folder ke `htdocs/` XAMPP
2. Import `db_bukutamu.sql` via phpMyAdmin
3. Sesuaikan `koneksi.php` dengan kredensial MySQL
4. Akses `http://localhost/UTS_RANU_RATMAJA_230401010104/`

---

## 🛡️ Keamanan

- **Prepared Statements** — mencegah SQL Injection
- **`htmlspecialchars()`** — mencegah XSS
- **Charset UTF-8** — mendukung karakter Unicode

---

*Dibuat oleh: Ranu Ratmaja — NIM: 230401010104 — UTS Pemrograman Web II 2026*
