# CATATAN SETUP - Aplikasi Aspirasi Siswa
# Oleh: Reyhanddinata

## LANGKAH SETUP DI HOSTING (WinSCP)

### 1. Upload File
- Upload semua isi folder project ini ke hosting via WinSCP
- Pastikan masuk ke folder public_html atau www

### 2. Setting .env
Buka file .env, ubah bagian database sesuai hosting:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=http://domain-sekolah-kamu.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database_hosting
DB_USERNAME=username_database_hosting
DB_PASSWORD=password_database_hosting
```

### 3. Jalankan Perintah (via Terminal/SSH)
```bash
composer install --no-dev
php artisan key:generate
php artisan migrate:fresh --seed
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### 4. Jika Tidak Ada Akses SSH
- Import file SQL manual via phpMyAdmin
- Jalankan migrate via browser menggunakan route khusus

---

## AKUN LOGIN

### Admin
- Username: admin
- Password: admin123

### Siswa
- NIS: 1 | Password: siswa123 | Nama: Reyhand | Kelas: XII RPL 1
- NIS: 2 | Password: siswa123 | Nama: Budi | Kelas: XII TKJ

---

## FITUR APLIKASI

### Siswa
- Login menggunakan NIS dan password
- Dashboard - melihat statistik aspirasi
- Buat Aspirasi - kirim aspirasi baru
- Riwayat - lihat semua aspirasi + filter per status
- Melihat feedback dan rating dari admin

### Admin
- Login menggunakan username dan password
- Dashboard - statistik semua aspirasi + filter
- Aspirasi Masuk - aspirasi yang belum diproses
- Semua Aspirasi - riwayat lengkap + filter per status
- Kelola Kategori - tambah dan hapus kategori
- Update status, feedback, dan rating bintang (1-5)

---

## STRUKTUR DATABASE

| Tabel | Keterangan |
|-------|-----------|
| siswa | Data akun siswa |
| admin | Data akun admin |
| kategori | Kategori aspirasi |
| input_aspirasi | Data aspirasi dari siswa |
| aspirasi | Feedback dan rating dari admin |

---

## TROUBLESHOOTING

### Error 500
- Cek file .env sudah benar
- Jalankan: php artisan config:clear

### Halaman Kosong / Error View
- Jalankan: php artisan view:clear

### Tabel Tidak Ada
- Jalankan: php artisan migrate:fresh --seed

### Session Error
- Jalankan: php artisan session:table && php artisan migrate
