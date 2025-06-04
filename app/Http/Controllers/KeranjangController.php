<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use PDF;
use App\Models\keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use App\Models\utangpiutang;
use App\Models\Utangpiutang_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Tampilkan halaman produk.
     */
    public function index()
    {
        return view('Pages.Storage');
    }

    /**
     * Tampilkan daftar barang untuk ditambahkan ke keranjang.
     */
    public function user()
    {
        $data = Keranjang::all();
        return view('Pages.Storage', compact('data'));
    }

    /**
     * Simpan produk ke dalam keranjang.
     */
    public function store(Request $request)
    {
        $data = [
            'harga' => $request->input('harga'),
            'barang_id' => $request->input('barang_id'),
            'jumlah_barang' => $request->input('jumlah_barang'),
        ];
        
        // Simpan ke keranjang
        Keranjang::create($data);

        // Ambil barang berdasarkan barang_id
        $barang = Barang::find($request->barang_id);

        if ($barang) {
            $barang->Quantity -= $request->jumlah_barang;
            $barang->save(); // WAJIB simpan perubahan
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        return redirect()->route('storage')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }


    /**
     * Hapus produk dari keranjang.
     */
    public function destroy($id)
    {
        
    }

    public function checkout(Request $request)
    {
        $keranjangItems = Keranjang::all();
        if ($keranjangItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong, tidak dapat checkout.');
        }

        // Hitung total
        $total = $keranjangItems->sum(function ($item) {
            return $item->harga * $item->jumlah_barang;
        });

        if ($request->status_pembayaran === 'Lunas') {
            // Proses Transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TX-' . now()->format('YmdHis') . Str::random(3),
                'user_id' => Auth::id() ?? 1,
                'total' => $total,
                'metode' => $request->metode_pembayaran,
                'status_bayar' => 'Lunas',
                'jenis' => 'Pemasukan',
            ]);

            foreach ($keranjangItems as $item) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item->barang_id,
                    'quantity' => $item->jumlah_barang,
                    'harga_satuan' => $item->harga,
                    'subtotal' => $item->harga * $item->jumlah_barang,
                ]);
            }

            Keranjang::query()->delete();
            // Arahkan ke struk dengan ID transaksi yang baru dibuat
            return redirect()->route('struk.show', $transaksi->id);

        } elseif ($request->status_pembayaran === 'Kredit') {
            // Proses Utang Piutang
            $tanggal = $request->input('tanggal');
            $utang = Utangpiutang::create([
                'kode_transaksi' => 'UT-' . now()->format('YmdHis') . Str::random(3),
                'jatuh_tempo' => $request->jatuhtempo,
                'nama' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'total' => $total,
                'metode' => $request->metode_pembayaran,
                'status' => 'belum',
                'jenis' => 'Piutang',             
                'tanggal' => now(),          
            ]); 
            
            // Buat entri transaksi untuk kredit
            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TX-' . now()->format('YmdHis') . Str::random(3),
                'user_id' => Auth::id() ?? 1,
                'total' => $total,
                'metode' => $request->metode_pembayaran,
                'nama' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'status_bayar' => 'Kredit',
                'jenis' => 'Pemasukan',
            ]);

            foreach ($keranjangItems as $item) {
                // Tambah ke utangpiutang_detail
                Utangpiutang_detail::create([
                    'transaksi_id' => $utang->id,
                    'barang_id' => $item->barang_id,
                    'quantity' => $item->jumlah_barang,
                    'harga_satuan' => $item->harga,
                    'subtotal' => $item->harga * $item->jumlah_barang,
                ]);

                // Tambah ke transaksi_detail juga
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id, // Menggunakan $transaksi->id
                    'barang_id' => $item->barang_id,
                    'quantity' => $item->jumlah_barang,
                    'harga_satuan' => $item->harga,
                    'subtotal' => $item->harga * $item->jumlah_barang,
                ]);
            }

            Keranjang::query()->delete();
            // Arahkan ke struk dengan ID transaksi yang baru dibuat
            return redirect()->route('struk.show', $transaksi->id);

        } else {
            return back()->with('error', 'Status pembayaran tidak valid.');
        }
    }
}