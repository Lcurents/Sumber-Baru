<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function index()
    {
        return view('pages/login'); // File Blade: resources/views/login.blade.php
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=>'username wajib di isi',
            'password.required'=>'password wajib di isi'
        ]);

        $infologin = [  
        'username'=>$request->username,
        'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            //kalau auth sukses
            return redirect()->route('dashboard');
        } else{
            //kalau auth gagal
            return view('pages/login');
        }

        
    }
    /**
     * Logout user dan bersihkan session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout');
    }

    // Method resource default (biarkan kosong jika tidak digunakan)
    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
