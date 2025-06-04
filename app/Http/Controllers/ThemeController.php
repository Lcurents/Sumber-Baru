<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function toggle(Request $request)
    {
        // Toggle antara 'active' (light) dan '' (dark)
        $current = $request->session()->get('theme', 'active');
        $new     = $current === 'active' ? '' : 'active';
        $request->session()->put('theme', $new);

        // Kembalikan 204 No Content agar fetch JS tidak redirect
        return response()->noContent();
    }
}
