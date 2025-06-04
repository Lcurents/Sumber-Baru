<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use App\Models\Storage;
use App\Models\keranjang;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Storage::all();  
        $query = DB::table('barang')
        ->join('satuan', 'barang.satuan', '=', 'satuan.ID') // ← Tambahkan join ke satuan di sini
        ->select(
            'barang.*',
            'satuan.nama as nama_satuan' // ← Ambil nama satuan juga
        )
        ->get();
        $keranjang = DB::table('keranjang')
    ->join('barang', 'keranjang.barang_id', '=', 'barang.id')
    ->select(
        'keranjang.*',
        'barang.Nama_Barang',
        'barang.gambar'
    )
    ->get();

        return view('pages.Storage',compact('data','keranjang','query'));
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
    public function show(Storage $storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Storage $storage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Storage $storage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Storage $storage)
    {
        //
    }
}
