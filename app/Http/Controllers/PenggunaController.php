<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Storage; // This model seems unused based on query building
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Inject Request
    {
        // Get the search term from the request
        $searchTerm = $request->input('search'); //

        $queryBuilder = DB::table('barang')
                        ->join('satuan', 'barang.satuan', '=', 'satuan.ID') //
                        ->select('barang.*', 'satuan.nama as nama_satuan'); //

        // Apply search filter if a search term is present
        if ($searchTerm) { //
            $queryBuilder->where('barang.Nama_Barang', 'like', '%' . $searchTerm . '%'); //
        }

        $query = $queryBuilder->get(); // Execute the query

        // 'data' variable seems unused in Pengguna.blade.php for the displayed items
        // You might consider removing it if it's not used, or populate it if needed elsewhere.
        $data = Storage::all(); // 

        return view('pages.Pengguna', compact('data', 'query')); //
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
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        //
    }
}