<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Tampilkan semua notifikasi (jika perlu halaman index).
     */
    public function index()
    {
        $notifikasi = Notifikasi::latest()->get();
        return view('notifikasi.index', compact('notifikasi'));
    }

    /**
     * Tambahkan notifikasi contoh.
     */
    public function addSampleNotif()
    {
        Notifikasi::create([
            'pesan' => '📦 Stok barang menipis',
            'is_read' => 0
        ]);

        return redirect()->back()->with('success', 'Notifikasi ditambahkan.');
    }

    /**
     * Hapus semua notifikasi.
     */
    public function destroyAll()
    {
        Notifikasi::truncate();
        return redirect()->back()->with('success', 'Semua notifikasi berhasil dihapus.');
    }

    /**
     * Hapus satu notifikasi berdasarkan ID.
     */
    public function destroy($id)
    {
        $notifikasi = Notifikasi::find($id);

        if (!$notifikasi) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $notifikasi->delete();
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
