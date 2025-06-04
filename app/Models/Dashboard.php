<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\utangpiutang;

class Dashboard
{
    public static function getSummaryData()
    {
        $barangHabis = Barang::where('Quantity', '<=', 0)->get();
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $totalPiutang = Utangpiutang::where('jenis', 'Piutang')->sum('total');
        $totalUtang = Utangpiutang::where('jenis', 'Utang')->sum('total');
        $selisih= $totalPiutang-$totalUtang;
    
        // FIX: periksa jika total barang > 0 untuk mencegah divide by zero
        $persentaseBarangHabis = $totalBarang > 0
            ? round(($barangHabis->count() / $totalBarang) * 100)
            : 0;
    
        $persentaseBarang = 100 - $persentaseBarangHabis;
    
        $persentaseTransaksi = $totalBarang > 0
            ? round(($totalTransaksi / $totalBarang) * 100)
            : 0;
    
        return [
            'total_barang' => $totalBarang,
            'barang_habis' => $barangHabis,
            'total_transaksi' => $totalTransaksi,
            'total_piutang' => $totalPiutang,
            'total_utang' => $totalUtang,
            'selisih' => $selisih,
            'persentase_barang_habis' => $persentaseBarangHabis,
            'persentase_barang' => $persentaseBarang,
            'persentase_transaksi' => $persentaseTransaksi,
        ];
    }
    
}
