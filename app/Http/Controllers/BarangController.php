<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.settings');
    }

    public function user()
    {
        $data = Barang::get();
        return view('Pages.settings',compact('data'));
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
        // dd($request);
       if ($request->hasFile('file')) {
            $file = $request->file('file');
            $md5 = md5($file->getClientOriginalName());
            $ext = $file->getClientOriginalExtension();
            $namefile = $md5 . '.' . $ext;
            $data = [
            'Nama_Barang'=>$request->input("Nama_Barang"),
            'Harga'=>$request->input("Harga"),
            'minimumbeli'=>$request->input("minimumbeli"),
            'maximumbeli'=>$request->input("maximumbeli"),
            'satuan'=>$request->input("satuan"),
            'supplier'=>$request->input("supplier"),
            'gambar' => $namefile,
            ];
            Barang::create($data);
            $file->move(base_path('../public_html/document'), $namefile);
        }
        return redirect()->route('settings')->with('suuccess','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $barang = Barang::findOrFail($id);

    $data = [
        'Nama_Barang' => $request->input('Nama_Barang'),
        'Harga' => $request->input('Harga'),
        'satuan' => $request->input('satuan'),
        'minimumbeli'=>$request->input("minimumbeli"),
        'maximumbeli'=>$request->input("maximumbeli"),
        'supplier' => $request->input('nama_supplier'),
    ];

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $md5 = md5($file->getClientOriginalName());
        $ext = $file->getClientOriginalExtension();
        $namefile = $md5 . '.' . $ext;

        // Hapus file lama
        $oldFilePath = public_path(base_path('../public_html/document') . $barang->gambar);
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        // Simpan file baru
        $file->move(base_path('../public_html/document'), $namefile);

        // Update field gambar
        $data['gambar'] = $namefile;
    }

    $barang->update($data);

    return redirect()->route('settings')->with('success', 'Data berhasil diupdate.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Barang::where('id',$id)->delete();
        return redirect()->route('settings')->with('suuccess','berhasil delete data');
    }
}
