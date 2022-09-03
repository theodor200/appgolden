<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobsController extends Controller
{
    public function dccStatus($site){
        $data = Http::withCookies(
            ["connect.sid" => $site->sid],
            "dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/ui/login/status')
            ->json();

            if(isset($data['loggedIn']) && $data['loggedIn']==true){
                return Log::info('ACTIVO: '.$site->name .' SID: '.$site->sid);
            }
            Log::info('INACTIVO: '.$site->name .' SID: '.$site->sid);
    }
}
