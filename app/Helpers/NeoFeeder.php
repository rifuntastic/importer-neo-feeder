<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class NeoFeeder {
    private $urlFeeder;
    private $username;
    private $password;
    private $act;

    function __construct($act)
    {
        $getSetting = Setting::find(1);

        if($getSetting['mode'] == 'live') {
            $urlFeeder = $getSetting['url_live'];
        } else {
            $urlFeeder = $getSetting['url_sandbox'];
        }

        $this->urlFeeder = $urlFeeder;
        $this->username = $getSetting['username'];
        $this->password = Crypt::decryptString($getSetting['password']);
        $this->act = $act;
    }

    private function getToken()
    {
        $response = Http::post($this->urlFeeder, [
            'act' => 'GetToken',
            'username' => $this->username,
            'password' => $this->password
        ]);

        return $response->json();
    }

    public function getData()
    {
        $getToken = $this->getToken();

        if($getToken['error_code'] == 0) {
            $token = $getToken['data']['token'];
            $this->act['token'] = $token;

            $response = Http::post($this->urlFeeder, $this->act);

            return $response->json();
        } else {
            return $getToken;
        }
    }
}
