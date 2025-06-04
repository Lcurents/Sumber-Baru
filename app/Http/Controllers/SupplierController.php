<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
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
        $data = Supplier::get();
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
        $data = [
            'nama_supplier'=>$request->input("nama_supplier"),
            'kontak'=>$request->input("kontak"),

        ];
        Supplier::create($data);
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
    
    $data = [
        'nama_supplier'=>$request->input("nama_supplier"),
        'kontak'=>$request->input("kontak"),

    ];

    Supplier::where('id',$id)->update($data);
    return redirect()->route('settings')->with('suuccess','berhasil update data');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Supplier::where('id',$id)->delete();
        return redirect()->route('settings')->with('suuccess','berhasil delete data');
    }
}
