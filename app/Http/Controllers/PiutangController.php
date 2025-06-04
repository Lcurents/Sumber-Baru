<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Pembukuan;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\utangpiutang;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $tampilkanSemua = $request->input('all');

        // JOIN transaksi_detail ke barang & transaksi
        $detail = DB::table('utangpiutang_detail')->join('barang', 'utangpiutang_detail.barang_id', '=', 'barang.id')->join('utangpiutang', 'utangpiutang_detail.transaksi_id', '=', 'utangpiutang.id')->select('utangpiutang_detail.*', 'barang.Nama_Barang as nama_barang', 'utangpiutang.jenis', 'utangpiutang.kode_transaksi', 'utangpiutang.created_at')->get();

        $query = utangpiutang::where('jenis', 'Piutang');

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

        $totalBelumLunas = utangpiutang::where('jenis', 'Piutang')
            ->where('status', 'belum')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->sum('total');

        return view('pages/Piutang', compact('detail', 'barangs', 'transaksi', 'startDate', 'endDate', 'tampilkanSemua','totalBelumLunas'));
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
    public function show(utangpiutang $utangpiutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(utangpiutang $utangpiutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, utangpiutang $utangpiutang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(utangpiutang $utangpiutang)
    {
        //
    }
}
