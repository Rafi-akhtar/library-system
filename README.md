# 📚 Library System & Digital Academic (Laravel)

Project aplikasi web perpustakaan digital dan sistem akademik berbasis Laravel untuk mengelola katalog buku, peminjaman, serta manajemen data anggota secara profesional.

---

## 📸 Tampilan Antarmuka (Screenshots)

### 1. Halaman Katalog (Sebelum Login / Guest)
Pengguna dapat menjelajahi katalog buku perpustakaan secara publik sebelum melakukan peminjaman.

### 2. Dashboard Admin (Setelah Login)
Admin memiliki akses penuh untuk mengelola buku, sirkulasi peminjaman, data anggota, hingga laporan perpustakaan.

---

## ✨ Fitur Utama
* **Katalog & Peminjaman Buku**: Menampilkan daftar buku lengkap dengan informasi stok yang tersedia.
* **Manajemen Wishlist**: Pengguna dapat menyimpan daftar buku favorit.
* **Menu Admin / Pengelolaan**:
  * Kelola Buku (Tambah, Edit, Hapus data buku)
  * Sirkulasi Peminjaman Buku
  * Manajemen Anggota
  * Laporan Perpustakaan

---

## ⚙️ Cara Instalasi & Menjalankan Project

Bagi yang ingin mencoba menjalankan project ini secara lokal, ikuti langkah-langkah berikut di terminal/command prompt:

1. **Clone repository ini:**
   ```bash
   git clone [https://github.com/Rafi-akhtar/library-system.git](https://github.com/Rafi-akhtar/library-system.git)

2. **Masuk ke direktori:**
    ```bash
    cd library-system
    
3. **Install dependencies PHP (Composer):**
   ```bash
   composer install

4. **Duplikat file konfigurasi environment:**
    ```bash
    cp .env.example .env

5. **Generate application key:**
   ```bash
   php artisan key:generate

6. **Konfigurasi Database:**
​   * Buat database baru di MySQL / Laragon.
​   * Sesuaikan pengaturan database (DB_DATABASE, DB_USERNAME, DB_PASSWORD) di dalam file .env

7. **Jalankan migrasi / import database:**
    ```bash
    php artisan migrate

8. **Jalankan server lokal:**
   ```bash
   php artisan serve

9. **Buka browser dan akses:**
   ```bash
    http://127.0.0.1:8000
