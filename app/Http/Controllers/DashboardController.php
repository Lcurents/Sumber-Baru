<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Transaksi;
use App\Models\utangpiutang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display dashboard with summary and chart data.
     */
    public function index()
    {
        // Menghitung total transaksi jenis Pemasukan
        $totalPemasukanCount = Transaksi::where('jenis', 'Pemasukan')->count();

        // Menghitung total transaksi jenis Pembelian/Pengeluaran
        // Asumsi nilai 'jenis' untuk pengeluaran adalah 'Pembelian' atau 'Pengeluaran'
        $totalPembelian = Transaksi::where('jenis', 'Pembelian')->count();
        // summary existing
        $data = Dashboard::getSummaryData();

        // total pemasukan & pengeluaran (lifetime)
        $totalPemasukan  = Transaksi::where('jenis', 'Pemasukan')->sum('total');
        $totalPengeluaran = Transaksi::where('jenis', 'Pembelian')->sum('total');

        // total beban (lifetime)
        $totalBeban = DB::table('beban')->sum('quantity');

        // jumlah piutang
        $jumlahPiutang = utangpiutang::where('jenis', 'Piutang')->count();
        $jumlahUtang = utangpiutang::where('jenis', 'Utang')->count();

        // keuntungan bersih (lifetime)
        $keuntungan = $totalPemasukan - $totalPengeluaran - $totalBeban;

        // chart data: 12 bulan terakhir
        $labels        = [];
        $pemasukan     = [];
        $pengeluaran   = [];
        $bebanBulanan  = [];

        for ($i = 11; $i >= 0; $i--) {
            $dt = Carbon::now()->subMonths($i);
            $labels[] = $dt->format('M Y');
        
            // pemasukan bulan ini
            $pemasukanBulanIni = Transaksi::where('jenis', 'Pemasukan')
                ->whereYear('created_at', $dt->year)
                ->whereMonth('created_at', $dt->month)
                ->sum('total');
            $pemasukan[] = $pemasukanBulanIni;
        
            // pengeluaran bulan ini
            $pengeluaranBulanIni = Transaksi::where('jenis', 'Pembelian')
                ->whereYear('created_at', $dt->year)
                ->whereMonth('created_at', $dt->month)
                ->sum('total');
            $pengeluaran[] = $pengeluaranBulanIni;
        
            // beban bulan ini
            $bebanBulanIni = DB::table('beban')
                ->whereYear('created_at', $dt->year)
                ->whereMonth('created_at', $dt->month)
                ->sum('quantity'); // asumsi quantity = nominal
            $bebanBulanan[] = $bebanBulanIni;
        
            // keuntungan bulan ini
            $keuntungan = $pemasukanBulanIni - ($pengeluaranBulanIni + $bebanBulanIni);
            $keuntunganGrafik[] = $keuntungan;
        }
        

        // keuntungan per bulan = pemasukan - pengeluaran - beban
        $keuntunganPerBln = [];
        for ($j = 0; $j < 12; $j++) {
            $keuntunganPerBln[] = $pemasukan[$j]
                                - $pengeluaran[$j]
                                - $bebanBulanan[$j];
        }

        return view('layout/dashboard', compact(
            'data',
            'totalPemasukan',
            'totalPengeluaran',
            'totalBeban',
            'keuntungan',
            'jumlahPiutang',
            'totalPembelian',
            'totalPemasukanCount',
            'labels',
            'pemasukan',
            'pengeluaran',
            'jumlahUtang',
            'keuntunganGrafik',
            'keuntunganPerBln'
        ));
    }

    // ... other methods unchanged ...
}

