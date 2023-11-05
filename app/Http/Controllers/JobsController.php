<?php

namespace App\Http\Controllers;

use App\Models\Glpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class JobsController extends Controller
{
    public function dccStatus($site):void
    {
        $data = Http::withCookies(
            ["connect.sid" => $site->sid],
            "dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/ui/login/status')
            ->json();
        if (isset($data['loggedIn']) && $data['loggedIn'] == true) {
            $log = 'DCC ACTIVO: '.$site->name.' SID: '.$site->sid;
        }else{
            $log = 'DCC INACTIVO: '.$site->name.' SID: '.$site->sid;
        }

        Log::info($log);
    }

    public function glpiStatus($glpi):void
    {
        $data = Http::withOptions([
                'verify' => false
            ])
            ->withCookies(
                        ["cookie" => $glpi->cookie],
                "mesadeservicios.intercorpretail.pe")
            ->get('https://mesadeservicios.intercorpretail.pe/glpi/front/central.php')->status();

        if ($data == '401') {
            $log = 'GLPI INACTIVO: '.$glpi->cookie;
        }else{
            $log = 'GLPI ACTIVO: '.$glpi->cookie;
        }

        Log::info($log);
    }

    public function session_glpi($cookie){
        $cookie_glpi = Glpi::find(1);
        $cookie_glpi->cookie = $cookie;
        $cookie_glpi->save();
    }
}
