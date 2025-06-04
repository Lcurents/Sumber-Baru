<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Penjualan;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap input tanggal
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        // Query header transaksi penjualan
        $query = DB::table('transaksi')->where('jenis', 'Pemasukan');

        // Paging dengan mempertahankan query string
        $transaksi = $query
            ->orderBy('transaksi.created_at', 'desc')
            ->paginate(10)
            ->appends($request->only(['start_date', 'end_date']));

        // Tambahkan status_piutang dari tabel utangpiutang
        $transaksi->getCollection()->transform(function ($item) {
            $piutang = DB::table('utangpiutang')
                ->where('total', $item->total)
                ->whereDate('created_at', Carbon::parse($item->created_at)->format('Y-m-d'))
                ->first();
            // Tambahkan properti custom untuk blade
            $item->status_piutang = $piutang?->status ?? null;
            $item->jatuh_tempo = $piutang?->jatuh_tempo ?? null;
            return $item;
        });
        // Query detail transaksi penjualan
        $detail = DB::table('transaksi_detail')->join('barang', 'transaksi_detail.barang_id', '=', 'barang.id')->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')->select(
            'transaksi_detail.*',
            'barang.Nama_Barang as nama_barang',
            'transaksi.id as transaksi_id', // PENTING!
            'transaksi.kode_transaksi',
            'transaksi.created_at',
        );

        $end = \Carbon\Carbon::parse($end_date)->endOfDay(); // 2025-05-03 23:59:59

        // Terapkan filter tanggal yang sama untuk detail
        if ($start_date && $end_date) {
            $detail->whereBetween('transaksi.created_at', [$start_date, $end]);
        } elseif ($start_date) {
            $detail->whereDate('transaksi.created_at', '>=', $start_date);
        } elseif ($end_date) {
            $detail->whereDate('transaksi.created_at', '<=', $end_date);
        }

        $detail = $detail->get();

        // Data untuk dropdown barang
        $barangs = Barang::all();

        // Kirim ke view
        return view('pages.Penjualan', compact('detail', 'barangs', 'transaksi', 'start_date', 'end_date',));
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
    public function show(Penjualan $Penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $Penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $Penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $Penjualan)
    {
        //
    }
}
