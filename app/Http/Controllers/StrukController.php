<?php

namespace App\Http\Controllers;

use App\Models\struk;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class StrukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $transaksi = Transaksi::orderBy('id', 'desc')->first();

    if (!$transaksi) {
        return redirect()->back()->with('error', 'Tidak ada transaksi ditemukan.');
    }

    $detail = TransaksiDetail::with('barang')
        ->where('transaksi_id', $transaksi->id)
        ->get();

    return view('pages.struk', compact('transaksi', 'detail'));
}

public function show($id)
{
    $transaksi = Transaksi::find($id);

    if (!$transaksi) {
        return redirect()->route('storage')->with('error', 'Transaksi tidak ditemukan.');
    }

    $detail = TransaksiDetail::with('barang')
        ->where('transaksi_id', $transaksi->id)
        ->get();

    if ($detail->isEmpty()) {
        return redirect()->route('storage')->with('error', 'Tidak ada detail transaksi untuk struk ini.');
    }

    // Cek apakah ada relasi barang yang null
    $barangKosong = $detail->filter(function ($item) {
        return $item->barang === null;
    });

    if ($barangKosong->isNotEmpty()) {
        return redirect()->route('storage')->with('error', 'Beberapa barang di struk tidak ditemukan dalam database.');
    }

    return view('pages.Struk', compact('transaksi', 'detail'));
}



    /**
     * Show the form for creating a new resource.
     */
   
}
