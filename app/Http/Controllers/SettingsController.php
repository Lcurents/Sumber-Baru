<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function showSettings(Request $request)
    {
        // Mendapatkan tab aktif dari request, default ke 'user'
        $activeTab = $request->input('activeTab', 'user');
        // Mendapatkan teks pencarian dari request
        $queryText = $request->input('query');

        // Inisialisasi query builder untuk setiap model
        $users = User::query();
        $barangs = DB::table('barang')
                        ->leftJoin('satuan', 'barang.satuan', '=', 'satuan.ID')
                        ->leftJoin('supplier', 'barang.supplier', '=', 'supplier.id')
                        ->select('barang.*', 'satuan.nama as nama_satuan', 'supplier.nama_supplier as nama_supplier');
        $satuans = Satuan::query();
        $suppliers = Supplier::query();

        // Menerapkan filter pencarian berdasarkan tab aktif
        if ($queryText) {
            if ($activeTab == 'user') {
                $users->where(function($q) use ($queryText) {
                    $q->where('name', 'like', "%$queryText%")
                      ->orWhere('username', 'like', "%$queryText%");
                });
            } elseif ($activeTab == 'barang') {
                $barangs->where('Nama_Barang', 'like', "%$queryText%");
            } elseif ($activeTab == 'satuan') {
                $satuans->where('nama', 'like', "%$queryText%");
            } elseif ($activeTab == 'supplier') {
                $suppliers->where('nama_supplier', 'like', "%$queryText%");
            }
        }

        // Mengambil data setelah filtering
        $usersData = $users->get();
        $barangsData = $barangs->get();
        $satuansData = $satuans->get();
        $suppliersData = $suppliers->get();

        return view('pages.settings', [
            'activeTab' => $activeTab,
            'queryText' => $queryText, // Kirimkan queryText kembali ke view untuk mengisi input pencarian
            'users' => $usersData,
            'barangs' => $barangsData, // Mengubah nama variabel agar konsisten dengan Blade
            'satuans' => $satuansData,
            'suppliers' => $suppliersData,
        ]);
    
}


   public function searchUsers(Request $request)
{
    $query = $request->input('query');
    $users = User::where('name', 'like', '%' . $query . '%')
                 ->orWhere('username', 'like', '%' . $query . '%')
                 ->get();

    return view('pages.settings', [
        'users' => $users,
        'barangs' => Barang::all(),
        'satuans' => Satuan::all(),
        'suppliers' => Supplier::all(),
        'query' => DB::table('barang')
            ->leftJoin('satuan', 'barang.satuan', '=', 'satuan.ID')
            ->leftJoin('supplier', 'barang.supplier', '=', 'supplier.id')
            ->select('barang.*', 'satuan.nama as nama_satuan', 'supplier.nama_supplier as nama_supplier')
            ->get(),
        'activeTab' => 'user',
    ]);
}

public function searchBarangs(Request $request)
{
    $queryText = $request->input('query');
    $query = DB::table('barang')
        ->leftJoin('satuan', 'barang.satuan', '=', 'satuan.ID')
        ->leftJoin('supplier', 'barang.supplier', '=', 'supplier.id')
        ->select('barang.*', 'satuan.nama as nama_satuan', 'supplier.nama_supplier as nama_supplier')
        ->where('Nama_Barang', 'like', '%' . $queryText . '%')
        ->get();

    return view('pages.settings', [
        'users' => User::all(),
        'barangs' => Barang::all(),
        'satuans' => Satuan::all(),
        'suppliers' => Supplier::all(),
        'query' => $query,
        'activeTab' => 'barang',
    ]);
}

public function searchSatuans(Request $request)
{
    $query = $request->input('query');
    $satuans = Satuan::where('nama', 'like', '%' . $query . '%')->get();

    return view('pages.settings', [
        'users' => User::all(),
        'barangs' => Barang::all(),
        'satuans' => $satuans,
        'suppliers' => Supplier::all(),
        'query' => DB::table('barang')
            ->leftJoin('satuan', 'barang.satuan', '=', 'satuan.ID')
            ->leftJoin('supplier', 'barang.supplier', '=', 'supplier.id')
            ->select('barang.*', 'satuan.nama as nama_satuan', 'supplier.nama_supplier as nama_supplier')
            ->get(),
        'activeTab' => 'satuan',
    ]);
}

public function searchSuppliers(Request $request)
{
    $query = $request->input('query');
    $suppliers = Supplier::where('nama_supplier', 'like', '%' . $query . '%')->get();

    return view('pages.settings', [
        'users' => User::all(),
        'barangs' => Barang::all(),
        'satuans' => Satuan::all(),
        'suppliers' => $suppliers,
        'query' => DB::table('barang')
            ->leftJoin('satuan', 'barang.satuan', '=', 'satuan.ID')
            ->leftJoin('supplier', 'barang.supplier', '=', 'supplier.id')
            ->select('barang.*', 'satuan.nama as nama_satuan', 'supplier.nama_supplier as nama_supplier')
            ->get(),
        'activeTab' => 'supplier',
    ]);
}
}
