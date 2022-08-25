<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobsController extends Controller
{
    public function dccStatus(){
        $data = Http::withCookies([
            "connect.sid"=>env('SID')
        ],"dcc.ext.hp.com")
            ->get(env('URL_STATUS'))
            ->json();
        $status = $data['loggedIn'] ? "Activa" : "Expiro";
        Log::info("Estado de la sesion es: {$status} ");
        return redirect('/');
    }
}
