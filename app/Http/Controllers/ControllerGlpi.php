<?php

namespace App\Http\Controllers;

use App\Models\Glpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ControllerGlpi extends Controller
{
    private function connectGlpi(){
        return Http::withHeaders([
            'Cookie'=> Glpi::all()->first()->cookie
        ])->withOptions([
            'verify' => false
        ]);
    }
    public function listTickets(){
        $response =$this->connectGlpi()->get('https://mesadeservicios.intercorpretail.pe/glpi/ajax/search.php?action=display_results&searchform_id=search_1288636887&itemtype=Ticket&glpilist_limit=1000&sort%5B%5D=1&order%5B%5D=ASC&is_deleted=0&as_map=0&browse=0&criteria%5B0%5D%5Blink%5D=AND&criteria%5B0%5D%5Bfield%5D=12&criteria%5B0%5D%5Bsearchtype%5D=equals&criteria%5B0%5D%5Bvalue%5D=notold&criteria%5B1%5D%5Blink%5D=AND&criteria%5B1%5D%5Bfield%5D=8&criteria%5B1%5D%5Bsearchtype%5D=equals&criteria%5B1%5D%5Bvalue%5D=219&savedsearches_id=1679&start=0');
        return $response->body();
        $crawler = new Crawler($response->body());


    }
}
