<?php

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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
        Route::get('logout', [ProfilController::class, 'logout']);

        Route::get('profil', [ProfilController::class, 'index']);
    });

});


