<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\Models\LaporanMinimum;
use Illuminate\Http\Request;

class LaporanMinimumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        // Ambil semua data dari tabel users, barang, dan satuan
      
        $barangs = DB::table('barang')
        ->join('satuan', 'barang.satuan', '=', 'satuan.id')
        ->select('barang.*', 'satuan.nama as nama_satuan')
        ->get();
    

        return view('pages/LaporanMinimum', compact('barangs'));
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
    public function show(LaporanMinimum $laporanMinimum)
    {
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanMinimum $laporanMinimum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanMinimum $laporanMinimum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanMinimum $laporanMinimum)
    {
        //
    }
}
