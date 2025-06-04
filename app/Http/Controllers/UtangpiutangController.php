<?php

namespace App\Http\Controllers;

use App\Models\Pembukuan;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\utangpiutang;
use Illuminate\Http\Request;

class UtangpiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $tampilkanSemua = $request->input('all');

        $detail = DB::table('utangpiutang_detail')->join('barang', 'utangpiutang_detail.barang_id', '=', 'barang.id')->join('utangpiutang', 'utangpiutang_detail.transaksi_id', '=', 'utangpiutang.id')->select('utangpiutang_detail.*', 'barang.Nama_Barang as nama_barang', 'utangpiutang.jenis', 'utangpiutang.kode_transaksi', 'utangpiutang.created_at')->get();

        $query = utangpiutang::where('jenis', '=', 'Utang');

        if (!$tampilkanSemua) {
            if ($startDate && $endDate) {
                $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
            } elseif ($startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            } elseif ($endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            }
        }

        $transaksi = $query->orderBy('created_at', 'desc')->paginate(10);
        $barangs = Barang::all();

        $totalBelumLunas = utangpiutang::where('jenis', 'Utang')
            ->where('status', 'belum')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->sum('total');

        return view('pages/utang', compact('detail', 'barangs', 'transaksi', 'startDate', 'endDate', 'tampilkanSemua','totalBelumLunas'));
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(utangpiutang $pembukuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(utangpiutang $pembukuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, utangpiutang $pembukuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(utangpiutang $pembukuan)
    {
        //
    }

    public function selesaikan($id)
    {
        $item = utangpiutang::findOrFail($id);
        // dd($item);
        $item->status = 'selesai';
        $item->save();

        return back()->with('success', 'Status berhasil diperbarui menjadi selesai.');
    }
}
