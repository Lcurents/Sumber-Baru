<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Str;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use App\Models\utangpiutang;
use App\Models\Utangpiutang_detail;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{

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
        // 1. Parse barang & supplier
        $parts       = explode('|', $request->input('barang'));
        $barangId    = $parts[0];
        $supplierId  = $parts[1];

        // 2. Hitung subtotal & ambil detail jumlah/harga
        $qty      = $request->input('quantity', 1);
        $harga    = $request->input('harga_satuan', 0);
        $subtotal = $request->biaya;

        // 3. Simpan Transaksi
        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-'.Str::upper(uniqid()),
            'metode'         => $request->metode,
            'total'          => $subtotal,
            'jenis'          => 'Pembelian',
            'deskripsi'      => $request->deskripsi,
            'supplier_id'    => $supplierId,
        ]);

        // 4. Simpan detail transaksi
        TransaksiDetail::create([
            'transaksi_id'  => $transaksi->id,
            'barang_id'     => $barangId,
            'quantity'      => $qty,
            'harga_satuan'  => $harga,
            'subtotal'      => $subtotal,
        ]);

        // 5. Update stok barang
        $barang = Barang::find($barangId);
        $barang->Quantity += $qty;
        $barang->save();

        // 6. Jika metode Kredit, buat juga utang + detail utang
        if ($request->metode === 'kredit') {
            // 6a. Utang utama
            $utang = Utangpiutang::create([
                'kode_transaksi' => 'UT-'.now()->format('YmdHis').Str::random(3),
                'jatuh_tempo'    => $request->jatuh_tempo,
                'deskripsi'=> $request->deskripsi,
                'total'          => $subtotal,
                'status'         => 'belum',
                'jenis'          => 'Utang',
                'tanggal' => now(),
            ]);

            // 6b. Detail utang
            Utangpiutang_detail::create([
                'transaksi_id'  => $utang->id,
                'barang_id'     => $barangId,
                'quantity'      => $qty,
                'harga_satuan'  => $harga,
                'subtotal'      => $subtotal,
            ]);
        }

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaksi $Transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $Transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $Transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $Transaksi,string $id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Data transaksi tidak ditemukan.');
        }
        
        $jenis = $transaksi->jenis;
        $transaksi->delete();
        
        if ($jenis === 'Pembelian') {
            return redirect()->route('Pembelian')->with('success', 'Data pembelian berhasil dihapus.');
        } elseif ($jenis === 'Penjualan') {
            return redirect()->route('Penjualan')->with('success', 'Data penjualan berhasil dihapus.');
        } else {
            return redirect()->back()->with('info', 'Data berhasil dihapus.');
        }
    }
}

