<?php

namespace App\Http\Controllers;

use App\Helpers\NeoFeeder;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $getProfilPT = new NeoFeeder([
            'act' => 'GetProfilPT'
        ]);

        $getCountProdi = new NeoFeeder([
            'act' => 'GetCountProdi'
        ]);

        $getCountDosen = new NeoFeeder([
            'act' => 'GetCountDosen'
        ]);

        $getCountMahasiswa = new NeoFeeder([
            'act' => 'GetCountMahasiswa'
        ]);

        return view('dashboard.profil.index', [
            'profil' => $getProfilPT->getData()['data'],
            'count_prodi' => $getCountProdi->getData()['data'],
            'count_dosen' => $getCountDosen->getData()['data'],
            'count_mahasiswa' => $getCountMahasiswa->getData()['data']
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/');
    }
}
