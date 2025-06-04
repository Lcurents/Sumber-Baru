<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = '2025-05';

        // Ambil tanggal dari request atau default ke bulan sekarang
        $start = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : Carbon::parse($bulan)->startOfMonth()->startOfDay();

        $end = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::parse($bulan)->endOfMonth()->endOfDay();

        $penjualan = DB::table('transaksi')
            ->select('id', 'kode_transaksi', 'total', 'status_bayar')
            ->whereRaw("LOWER(jenis) = 'pemasukan'")
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'asc')
            ->get();

        $totalPenjualan = $penjualan->sum('total');

        $totalSaldo = $penjualan->sum(function ($row) {
            return strtolower($row->status_bayar) === 'lunas' ? 0 : $row->total;
        });

        return view('pages.LaporanPenjualan', compact('penjualan', 'start', 'end', 'bulan', 'totalPenjualan','totalSaldo'));
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
    public function show(LaporanPenjualan $laporanPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanPenjualan $laporanPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanPenjualan $laporanPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPenjualan $laporanPenjualan)
    {
        //
    }
}
