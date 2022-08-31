<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class JobsController extends Controller
{
    public function dccStatus(){
        $id=env('SID');
        $id_end_time=env('SID_EXPIRA');
        $data = Http::withCookies([
            "connect.sid"=>$id
        ],"dcc.ext.hp.com")
            ->get(env('URL_STATUS'))
            ->json();
        $status = $data['loggedIn'] ? "Activa" : "Expiro";
        Log::info("Estado de la sesion es: {$status} con el ID {$id} y vence el {$id_end_time});
        return redirect('/');
    }
}
