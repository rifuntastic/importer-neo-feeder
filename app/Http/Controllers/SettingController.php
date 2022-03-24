<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    public function index()
    {
        if(session()->has('kode')) {
            return redirect('dashboard/profil');
        }

        return view('front.setting');
    }

    public function checkSetting(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'url' => 'required|url',
        ]);

        $urlLive = $request->url . ':3003/ws/live2.php';
        $urlSandbox = $request->url . ':3003/ws/sandbox2.php';

        try {
            $getToken = Http::post($urlLive, [
                'act' => 'GetToken',
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $responseGetToken = $getToken->json();

            if($responseGetToken['error_code'] == 0) {
                Setting::updateOrCreate(
                    [
                        'id' => '1',
                    ],
                    [
                        'username' => $request->username,
                        'password' => Crypt::encryptString($request->password),
                        'url_live' => $urlLive,
                        'url_sandbox' => $urlSandbox,
                        'mode' => 'live',
                    ]
                );

                $getProfilPT = Http::post($urlLive, [
                    'act' => 'GetProfilPT',
                    'token' => $responseGetToken['data']['token'],
                ]);

                $responseGetProfilPT = $getProfilPT->json();

                $request->session()->put([
                    'kode' => $responseGetProfilPT['data'][0]['kode_perguruan_tinggi'],
                    'nama' => $responseGetProfilPT['data'][0]['nama_perguruan_tinggi'],
                ]);

                return redirect('dashboard/profil')->with('success', 'Berhasil terhubung dengan aplikasi Neo Feeder ' . $responseGetProfilPT['data'][0]['nama_perguruan_tinggi']);
            } else {
                return redirect('setting')->with('error', Str::ucfirst($responseGetToken['error_desc']));
            }
        } catch (\Throwable $th) {
            return redirect('setting')->with('error', 'Tidak dapat terhubung dengan aplikasi Neo Feeder. Silakan periksa kembali isian anda');
        }

    }
}
