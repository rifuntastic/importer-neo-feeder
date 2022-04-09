<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SandboxController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);

        return view('dashboard.sandbox.index', [
            'mode_selected' => $setting['mode']
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'koneksi' => 'required',
        ]);

        $koneksi = Setting::find(1);
        $koneksi->mode = $request->koneksi;
        $koneksi->save();

        return redirect()->back()->with('success', 'Berhasil disimpan');
    }
}
