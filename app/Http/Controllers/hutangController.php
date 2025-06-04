<?php

namespace App\Http\Controllers;

use App\Models\utangpiutang;
use App\Models\Barang;
use App\Models\Utangpiutang_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $tampilkanSemua = $request->input('all');
    
        // JOIN transaksi_detail ke barang & transaksi
        $detail = DB::table('transaksi_detail')
            ->join('barang', 'transaksi_detail.barang_id', '=', 'barang.id')
            ->join('transaksi', 'transaksi_detail.transaksi_id', '=', 'transaksi.id')
            ->select(
                'transaksi_detail.*',
                'barang.Nama_Barang as nama_barang',
                'transaksi.jenis',
                'transaksi.kode_transaksi',
                'transaksi.created_at',
                'transaksi.updated_at'
            )
            ->get();

    
        $query = Utangpiutang::query();
    
        if (!$tampilkanSemua && $tanggal) {
            $query->whereDate('created_at', $tanggal);
        }
    
        $transaksi = $query->orderBy('created_at', 'desc')->paginate(10);
        $barangs = Barang::all();
    
        return view('pages/Pembukuan', compact('detail', 'barangs', 'transaksi', 'tanggal', 'tampilkanSemua'));
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
    // Validasi form input
    // $request->validate([
    //     'barang' => 'required_if:jenis,Utang',
    //     'quantity' => 'required_if:jenis,Utang|numeric|min:1',
    //     'biaya' => 'required|numeric',
    //     'jatuh_tempo' => 'required|date',
    //     'deskripsi' => 'nullable|string',
    //     'jenis' => 'required|string',
    // ]);

    $quantity = $request->quantity ?? 1;
    $subtotal = $quantity * $request->biaya;

    // Simpan transaksi utama
    $transaksi = Utangpiutang::create([
        'kode_transaksi' => 'TRX-' . strtoupper(uniqid()),
        'total' => $subtotal,
        'jenis' => $request->jenis,
        'deskripsi' => $request->deskripsi,
        'jatuh_tempo' => $request->jatuh_tempo,
        'status' => 'belum',
        'tanggal' => now(),
    ]);

    // Jika jenisnya adalah "utang", buat detailnya
    // if (strtolower(trim($request->jenis)) == 'utang') {
    //     Utangpiutang_detail::create([
    //         'transaksi_id' => $transaksi->id,
    //         'barang_id' => $request->barang,
    //         'quantity' => $quantity,
    //         'harga_satuan' => $request->biaya,
    //         'subtotal' => $subtotal,
    //     ]);

    //     // Update stok barang
    //     $barang = Barang::find($request->barang);
    //     if ($barang) {
    //         $barang->Quantity += $quantity;
    //         $barang->save();
    //     }
    // }

    return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
}




    /**
     * Display the specified resource.
     */
    public function show(Utangpiutang $utangpiutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utangpiutang $utangpiutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utangpiutang $utangpiutang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utangpiutang $utangpiutang, string $id)
    {
        utangpiutang::where('id',$id)->delete();
        return redirect()->route('Piutang')->with('suuccess','berhasil delete data');
    }
}
