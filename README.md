-----

# Proyek Sumber Baru - Sistem Informasi Akuntansi & POS

**Sumber Baru** adalah aplikasi web berbasis Sistem Informasi Akuntansi (SIA) dan Point of Sale (POS) yang dirancang untuk membantu pengelolaan bisnis secara komprehensif. Aplikasi ini dibangun untuk menangani manajemen transaksi, kontrol inventaris, pelacakan finansial (utang/piutang), hingga pelaporan bisnis yang mendalam.

## 📋 Tentang Proyek

Proyek ini bertujuan untuk menciptakan solusi digital terpusat bagi UMKM atau unit usaha agar dapat mengelola operasional bisnis dengan lebih efisien dan terstruktur. Dari pencatatan penjualan harian hingga pembuatan laporan laba rugi, semua dirancang dalam satu platform yang terintegrasi.

## ✨ Fitur Utama

Berdasarkan rancangan, berikut adalah fitur-fitur inti yang akan ada di dalam aplikasi Sumber Baru:

  * **Dashboard Analitik:** Tampilan ringkasan data bisnis secara *real-time* untuk pengambilan keputusan yang cepat.
  * **Manajemen Transaksi:** Modul terpisah untuk mengelola seluruh transaksi **Penjualan** dan **Pembelian**.
  * **Manajemen Finansial:** Pelacakan **Utang** kepada supplier dan **Piutang** dari pelanggan dengan alur kerja untuk status pelunasan.
  * **Manajemen Inventaris (Stok):** Kontrol penuh atas data barang, kuantitas, harga, hingga notifikasi stok minimum.
  * **Sistem Pelaporan:** Kemampuan untuk menghasilkan berbagai laporan penting seperti Laporan Penjualan, Laporan Pembelian, dan Laporan Laba Rugi.
  * **Manajemen Data Master:** Pengelolaan data-data inti seperti Pengguna (User), Supplier, Pelanggan, dan Satuan Barang.
  * **Sistem Peran Pengguna:** Pembagian hak akses antara **Admin** dan peran lainnya.

## 🚀 Teknologi yang Digunakan

  * **Backend:** Laravel 12
  * **Frontend:** Bootstrap 5, Blade Template Engine
  * **Database:** MySQL / PostgreSQL (dapat disesuaikan di `.env`)
  * **Server Development Lokal:** `php artisan serve`
  * **Asset Bundling:** Vite

## ⚙️ Rincian Modul & Fungsionalitas

### 1\. Dashboard

  - Visualisasi total pemasukan, pengeluaran, dan keuntungan.
  - Kartu ringkasan untuk jumlah penjualan, utang, piutang, dan barang habis.
  - Tautan cepat ke modul-modul laporan utama.

### 2\. Penjualan & Piutang

  - Pencatatan transaksi penjualan dengan berbagai metode pembayaran (Tunai, Transfer, Kredit).
  - Jika pembayaran kredit, otomatis membuat entri pada modul **Piutang**.
  - Tabel data penjualan dengan filter berdasarkan periode.
  - Saat piutang lunas, status transaksi di Penjualan akan diperbarui.

### 3\. Pembelian & Utang

  - Pencatatan transaksi pembelian barang dari supplier.
  - Otomatis membuat entri pada modul **Utang**.
  - Tabel data pembelian dengan filter berdasarkan periode.
  - Saat utang lunas, status transaksi di Pembelian akan diperbarui.

### 4\. Manajemen Stok (Storage)

  - Tampilan galeri produk dengan gambar, nama, harga, dan kuantitas.
  - Fitur "Keranjang" untuk proses penjualan.
  - Manajemen data barang termasuk stok minimum dan maksimum.

### 5\. Laporan

  - Laporan Penjualan (Harian, Periodik).
  - Laporan Pembelian.
  - Laporan Laba Rugi.
  - Laporan Stok (Barang yang akan habis, Stok minimum).
  - Cetak laporan dalam format PDF atau ekspor ke Excel.

### 6\. Pengaturan (Settings)

  - **Manajemen User:** CRUD untuk data pengguna dan hak aksesnya.
  - **Manajemen Barang:** CRUD untuk semua item produk.
  - **Manajemen Supplier:** CRUD untuk data pemasok.
  - **Manajemen Satuan:** CRUD untuk satuan barang (Pcs, Kg, Box, dll).

## 📦 Instalasi & Setup Proyek

Untuk menjalankan proyek ini di lingkungan lokal, ikuti langkah-langkah berikut:

1.  **Clone repositori ini:**

    ```bash
    git clone https://github.com/[NAMA_USER_ANDA]/[NAMA_REPOSITORI_ANDA].git
    ```

2.  **Masuk ke direktori proyek:**

    ```bash
    cd [NAMA_REPOSITORI_ANDA]
    ```

3.  **Install dependensi Composer:**

    ```bash
    composer install
    ```

4.  **Salin file environment:**

    ```bash
    cp .env.example .env
    ```

5.  **Buat kunci aplikasi (Application Key):**

    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi database Anda di file `.env`:**

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sumber_baru
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Jalankan migrasi database untuk membuat tabel:**

    ```bash
    php artisan migrate
    ```

8.  **(Opsional) Jalankan seeder untuk mengisi data awal:**

    ```bash
    php artisan db:seed
    ```

9.  **Install dependensi NPM:**

    ```bash
    npm install
    ```

10. **Jalankan Vite untuk kompilasi aset:**

    ```bash
    npm run dev
    ```

11. **Jalankan server development Laravel:**

    ```bash
    php artisan serve
    ```

Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`.

-----
