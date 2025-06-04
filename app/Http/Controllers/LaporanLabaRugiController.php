<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\LaporanLabaRugi;

class LaporanLabaRugiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil periode dari input, default ke bulan berjalan
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : Carbon::now()->startOfMonth();

        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now()->endOfMonth();

        // Hitung total pemasukan
        $totalPemasukan = DB::table('transaksi')
            ->whereRaw("jenis = 'Pemasukan'")
            ->sum('total');

        // Hitung total pembelian
        $totalPembelian = DB::table('transaksi')
            ->whereRaw("jenis = 'Pembelian'")
            ->sum('total');
        // Penjualan Bersih = Pemasukan - Pembelian
        $penjualanBersih = $totalPemasukan ;

        // Total Beban
        $totalBeban = DB::table('beban')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('quantity'); // gunakan kolom quantity sebagai nominal beban

 $totalBeban += $totalPembelian;
        // Laba Bersih
        $labaBersih = $penjualanBersih - $totalBeban;

        return view('pages.LaporanLabaRugi', compact('penjualanBersih', 'totalBeban','labaBersih', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanLabaRugi $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanLabaRugi $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanLabaRugi $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanLabaRugi $laporan)
    {
        //
    }
}
