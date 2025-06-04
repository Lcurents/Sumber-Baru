<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\UtangpiutangController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\hutangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\LaporanLabaRugiController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanMinimumController;
use App\Http\Controllers\LaporanYangDibeliController;
use App\Http\Controllers\LaporanBbnController;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| Route untuk Pengguna yang Belum Login
|--------------------------------------------------------------------------
*/
// Tampilkan form login
Route::get('/', [PenggunaController::class, 'index'])->name('pengguna');

Route::get('/login', [LoginController::class, 'index'])->name('login');

// Proses login
Route::post('/logins', [LoginController::class, 'login'])->name('login.post');

/*
|--------------------------------------------------------------------------
| Route untuk Pengguna yang Sudah Login (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Halaman utama (dashboard)

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/Penjualan', [PenjualanController::class, 'index'])->name('Penjualan');
    Route::get('/Pembelian', [PembelianController::class, 'index'])->name('Pembelian');

    Route::get('/Utang', [UtangpiutangController::class, 'index'])->name('utangpiutang');

    Route::get('/Price', [PriceController::class, 'index'])->name('Price');
    Route::get('/Piutang', [PiutangController::class, 'index'])->name('Piutang');
    // Menyelesaikan transaksi
    Route::post('/utangpiutang/{id}/selesaikan', [UtangpiutangController::class, 'selesaikan'])->name('utangpiutang.selesaikan');

    // Hapus data
    Route::delete('/utangpiutang/{id}/delete', [UtangpiutangController::class, 'destroy'])->name('utangpiutang.delete');
    // Storage
    Route::get('/Storage', [StorageController::class, 'index'])->name('storage');
    Route::get('/struk/{id}', [KeranjangController::class, 'printStruk'])->name('struk.print');

    Route::get('/struk/{id}', [StrukController::class, 'show'])->name('struk.show');

    // Proses logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Settings

    Route::get('/settings', [SettingsController::class, 'showSettings'])->name('settings');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    // tambah user
    route::post('/user', [UserController::class, 'store'])->name('user.post');
    // update user
    route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    // delete user
    route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');

    // tambah pemasok
    Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.post');

    // update pemasok
    Route::put('/satuan/{id}', [SatuanController::class, 'update'])->name('satuan.update');

    // delete pemasok
    Route::delete('/satuan/{id}', [SatuanController::class, 'destroy'])->name('satuan.delete');

    // tambah barang
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.post');

    // update barang
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');

    // delete barang
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.delete');

    //keranjang
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');

    Route::put('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');

    // tambah supplier
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.post');

    // update supplier
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');

    // delete supplier
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');

    // Searching Setting

   Route::get('/settings', [SettingsController::class, 'showSettings'])->name('settings');
Route::get('/settings/barangs/search', [SettingsController::class, 'searchBarangs'])->name('settings.searchBarangs');
Route::get('/settings/users/search', [SettingsController::class, 'searchUsers'])->name('settings.searchUsers');
Route::get('/settings/satuans/search', [SettingsController::class, 'searchSatuans'])->name('settings.searchSatuans');
Route::get('/settings/suppliers/search', [SettingsController::class, 'searchSuppliers'])->name('settings.searchSuppliers');

    // transaksi
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.post');

    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.delete');

    // UtangPiutang
    Route::post('/utang', [hutangController::class, 'store'])->name('utangpiutang.post');
    Route::delete('/utang/{id}', [hutangController::class, 'destroy'])->name('utangpiutang.delete');
    //Laporan
    Route::get('/LaporanLabaRugi', [LaporanLabaRugiController::class, 'index'])->name('LaporanLabaRugi');
    Route::get('/LaporanPenjualan', [LaporanPenjualanController::class, 'index'])->name('LaporanPenjualan');
    Route::get('/LaporanPembelian', [LaporanPembelianController::class, 'index'])->name('LaporanPembelian');
    Route::get('/LaporanMinimum', [LaporanMinimumController::class, 'index'])->name('LaporanMinimum');

    //Laporan yang  akan Dibeli
    Route::get('/LaporanYangDibeli', [LaporanYangDibeliController::class, 'index'])->name('LaporanYangDibeli');
    Route::get('/laporan/barang-dibeli', [LaporanYangDibeliController::class, 'index'])->name('LaporanYangDibeli');

    // Laporan Beban
    Route::get('/LaporanBbn', [LaporanBbnController::class, 'index'])->name('LaporanBbn');

    Route::resource('laporanbbn', LaporanBbnController::class);

    Route::post('/utangpiutang/{id}/selesaikan', [UtangpiutangController::class, 'selesaikan'])->name('utangpiutang.selesaikan');

    // Hapus semua notifikasi
    Route::delete('/notifikasi/hapus-semua', [NotifikasiController::class, 'destroyAll'])->name('notifikasi.destroyAll');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
});
Route::post('/theme/toggle', [ThemeController::class, 'toggle'])->name('theme.toggle');
