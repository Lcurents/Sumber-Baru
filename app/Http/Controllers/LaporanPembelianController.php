<?php

namespace App\Http\Controllers;

use App\Models\LaporanPembelian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
    $bulan = '2025-05'; // bisa kamu ganti ke dinami
    
    // Hitung rentang tanggal awal dan akhir bulan
    $start = Carbon::parse($bulan)->startOfMonth()->startOfDay();
    $end = Carbon::parse($bulan)->endOfMonth()->endOfDay();

    // Ambil data pembelian dari join antara transaksi, transaksi_detail, dan barang
    $pembelian = DB::table('transaksi_detail')
    ->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')
    ->join('barang', 'transaksi_detail.barang_id', '=', 'barang.id')
    ->join('supplier', 'transaksi.supplier_id', '=', 'supplier.id')
        ->select(
        'transaksi.created_at as tanggal',
        'barang.id as kode',
        'supplier.nama_supplier as supplier', // Ambil nama suplayer
        'barang.Nama_Barang as nama',
        'transaksi_detail.quantity as jumlah',
        'transaksi_detail.harga_satuan as harga'
    )
    ->whereRaw("LOWER(transaksi.jenis) = 'pembelian'")
    ->whereBetween('transaksi.created_at', [$start, $end])
    ->orderBy('transaksi.created_at', 'asc')
    ->get();

    return view('pages.LaporanPembelian', compact('pembelian', 'bulan'));
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
    public function show(LaporanPembelian $laporanPembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanPembelian $laporanPembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanPembelian $laporanPembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPembelian $laporanPembelian)
    {
        //
    }
}
