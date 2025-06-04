<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Pembukuan;
use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Tangkap input tanggal
    $start_date = $request->get('start_date');
    $end_date   = $request->get('end_date');

    // Query header transaksi
    $query = DB::table('transaksi')
        ->join('supplier', 'transaksi.supplier_id', '=', 'supplier.id')
        ->select(
            'transaksi.*',
            'supplier.nama_supplier',
            'supplier.kontak'
        );

    // Dinamis filter berdasarkan tanggal
    $end = \Carbon\Carbon::parse($end_date)->endOfDay(); // 2025-05-03 23:59:59
    if ($start_date && $end_date) {
        $query->whereBetween('transaksi.created_at', [$start_date, $end]);
    } elseif ($start_date) {
        $query->whereDate('transaksi.created_at', '>=', $start_date);
    } elseif ($end_date) {
        $query->whereDate('transaksi.created_at', '<=', $end_date);
    }

    // Paging dengan mempertahankan query string
    $transaksi = $query
        ->orderBy('transaksi.created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

    // Query detail (jika ingin difilter juga)
    $detailQuery = DB::table('transaksi_detail')
        ->join('barang', 'transaksi_detail.barang_id', '=', 'barang.id')
        ->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')
        ->join('supplier', 'barang.supplier', '=', 'supplier.id')
        ->select(
            'transaksi_detail.*',
            'barang.Nama_Barang as nama_barang',
            'transaksi.kode_transaksi',
            'transaksi.created_at',
            'supplier.nama_supplier as nama_supplier'
        );

    if ($start_date && $end_date) {
        $detailQuery->whereBetween('transaksi.created_at', [$start_date, $end_date]);
    } elseif ($start_date) {
        $detailQuery->whereDate('transaksi.created_at', '>=', $start_date);
    } elseif ($end_date) {
        $detailQuery->whereDate('transaksi.created_at', '<=', $end_date);
    }

    $detail = $detailQuery->get();

    // Data untuk dropdown
    $barangs = Barang::all();

    // Kirim ke view
    return view('pages.Pembelian', compact(
        'detail',
        'barangs',
        'transaksi',
        'start_date',
        'end_date'
    ));
    
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
    public function show(Pembelian $Pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $Pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $Pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $Pembelian)
    {
        //
    }
}
