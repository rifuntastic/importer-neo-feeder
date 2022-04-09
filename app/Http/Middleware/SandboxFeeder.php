<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class SandboxFeeder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::find(1);

        if($setting->mode == 'sandbox') {
            $url = $setting->url_sandbox;
        } else {
            $url = $setting->url_live;
        }

        $getToken = Http::post($url, [
            'act' => 'GetToken',
            'username' => $setting->username,
            'password' => Crypt::decryptString($setting->password),
        ]);

        $responseGetToken = $getToken->json();

        if($responseGetToken['error_code'] == 0) {
            return $next($request);
        } else {
            return redirect('dashboard/error');
        }

    }
}
