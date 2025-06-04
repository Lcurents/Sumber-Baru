<?php

namespace App\Http\Controllers;

use App\Models\LaporanBbn;
use Illuminate\Http\Request;

class LaporanBbnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LaporanBbn::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }
    
        $laporanBbns = $query->orderBy('created_at', 'desc')->get();
    
        return view('pages.LaporanBbn', compact('laporanBbns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        // Simpan data baru ke database
        LaporanBbn::create($validated);

        return redirect()->route('laporanbbn.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        // Temukan data berdasarkan ID dan hapus
        $laporanBbn = LaporanBbn::findOrFail($id);
        $laporanBbn->delete();

        return redirect()->route('laporanbbn.index')->with('success', 'Data berhasil dihapus.');
    }
}
