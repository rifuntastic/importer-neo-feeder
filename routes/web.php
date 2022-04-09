<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SandboxController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ReferensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SettingController::class, 'index']);
Route::get('setting', [SettingController::class, 'index']);
Route::post('check-setting', [SettingController::class, 'checkSetting']);

Route::middleware('authneofeeder')->group(function() {
    Route::prefix('dashboard')->group(function () {
        Route::middleware('sandbox')->group(function() {
            Route::get('profil', [ProfilController::class, 'index']);

            Route::get('mahasiswa', [MahasiswaController::class, 'index']);

            Route::get('ref-agama', [ReferensiController::class, 'agama']);
            Route::get('ref-alat-transportasi', [ReferensiController::class, 'alatTransportasi']);
            Route::get('ref-jalur-daftar', [ReferensiController::class, 'jalurDaftar']);
            Route::get('ref-jenis-tinggal', [ReferensiController::class, 'jenisTinggal']);
            Route::get('ref-jenjang-pendidikan', [ReferensiController::class, 'jenjangPendidikan']);
            Route::get('ref-kebutuhan-khusus', [ReferensiController::class, 'kebutuhanKhusus']);
            Route::get('ref-negara', [ReferensiController::class, 'negara']);
            Route::get('ref-pekerjaan', [ReferensiController::class, 'pekerjaan']);
            Route::get('ref-pembiayaan', [ReferensiController::class, 'pembiayaan']);
            Route::get('ref-penghasilan', [ReferensiController::class, 'penghasilan']);
            Route::get('ref-wilayah', [ReferensiController::class, 'wilayah']);
            Route::get('ref-wilayah-provinsi', [ReferensiController::class, 'wilayahProvinsi']);
            Route::get('ref-wilayah-kota', [ReferensiController::class, 'wilayahKota']);
            Route::get('ref-wilayah-kecamatan', [ReferensiController::class, 'wilayahKecamatan']);
        });

        Route::get('error', function () {
            return view('layouts.error');
        });

        Route::get('logout', [ProfilController::class, 'logout']);

        Route::get('sandbox', [SandboxController::class, 'index']);
        Route::put('sandbox', [SandboxController::class, 'update']);
    });
});


