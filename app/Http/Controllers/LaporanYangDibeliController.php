<?php

namespace App\Http\Controllers;

use App\Models\LaporanYangDibeli;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class LaporanYangDibeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $data = DB::table('barang')
        ->join('supplier', 'barang.supplier', '=', 'supplier.id')
        ->select(
            'barang.Nama_Barang',
            'barang.ID as kode_barang',
            'barang.Quantity',
            'barang.minimumbeli',
            'supplier.nama_supplier'
        )
        ->whereColumn('barang.Quantity', '<', 'barang.minimumbeli')
        ->get();

    return view('pages.LaporanYangDibeli', compact('data'));
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
    public function show(LaporanYangDibeli $laporanYangDibeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanYangDibeli $laporanYangDibeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanYangDibeli $laporanYangDibeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanYangDibeli $laporanYangDibeli)
    {
        //
    }
}
