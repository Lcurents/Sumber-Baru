<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
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
        $data = Pemasok::get();
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
                'nama'=>$request->input("nama"),
                'deskripsi'=>$request->input("deskripsi"),

            ];
            Pemasok::create($data);
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
            'nama'=>$request->input("nama"),
            'deskripsi'=>$request->input("deskripsi"),

        ];
    
        Pemasok::where('id',$id)->update($data);
        return redirect()->route('settings')->with('suuccess','berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Pemasok::where('id',$id)->delete();
        return redirect()->route('settings')->with('suuccess','berhasil delete data');
    }
}
