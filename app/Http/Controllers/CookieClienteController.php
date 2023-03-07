<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CookieClienteController extends Controller
{
    public function cookieIngramStatus($cliente):void
    {
        $data = Http::withCookies(
            ["ASP.NET_SessionId"=>$cliente->cookie],
            "www.ingrammicromps.com")
            ->get('https://www.ingrammicromps.com/hpmps/ajax/bloqueo.aspx')
            ->body();
        if ($data=='OK') {
            $log = 'ACTIVO: '.$cliente->cliente.' COOKIE: '.$cliente->cookie;
        }else{
            $log = 'INACTIVO: '.$cliente->cliente.' SID: '.$cliente->cookie;
        }

        Log::info($log);
    }
}
