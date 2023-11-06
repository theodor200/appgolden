<?php

namespace App\Http\Livewire;

use App\Models\Glpi;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Symfony\Component\DomCrawler\Crawler;

class GlpiTickets extends Component
{

    public $tickets;

    public function mount(){
        $response = $this->connectGlpi()->get('https://mesadeservicios.intercorpretail.pe/glpi/ajax/search.php?action=display_results&searchform_id=search_1288636887&itemtype=Ticket&glpilist_limit=1000&sort%5B%5D=1&order%5B%5D=ASC&is_deleted=0&as_map=0&browse=0&criteria%5B0%5D%5Blink%5D=AND&criteria%5B0%5D%5Bfield%5D=12&criteria%5B0%5D%5Bsearchtype%5D=equals&criteria%5B0%5D%5Bvalue%5D=notold&criteria%5B1%5D%5Blink%5D=AND&criteria%5B1%5D%5Bfield%5D=8&criteria%5B1%5D%5Bsearchtype%5D=equals&criteria%5B1%5D%5Bvalue%5D=219&savedsearches_id=1679&start=0');
        $crawler = new Crawler($response->body());
        //$total_tickets = $crawler->filter('tbody')->children()->count();

        $collect_tickets = collect($crawler->filter('tbody')->children());

        $response = $collect_tickets->map(function ($ticket){

            // Datos generales
            $DOM = new Crawler($ticket);
            if($DOM->children()->eq(12)->children()->count() != 0){
                $tecnico = $DOM->children()->eq(12)->children()->eq(1)->children()->eq(0)->children()->eq(0)->children()->eq(1)->children()->eq(0)->text();
            }else{
                $tecnico = 'Sin datos';
            }
            $numero_ticket = str_replace(' ','',$DOM->children()->eq(1)->text());
            //$asignacion_historico = $this->ticketAsignacionHistorico($numero_ticket);
            return [
                'numero' => $numero_ticket,
                'entidad' => $DOM->children()->eq(3)->children()->eq(0)->children()->eq(2)->text(),
                'estado' => $DOM->children()->eq(4)->text(),//No
                'tipo' => $DOM->children()->eq(7)->text(),
                'apertura' => $DOM->children()->eq(8)->text(),
                'actualizacion' => $DOM->children()->eq(9)->text(),
                'grupo' => $DOM->children()->eq(11)->text(),
                'tecnico' => $tecnico,
                'locazion' => $DOM->children()->eq(13)->text(),
                //'historico'=> array_filter($asignacion_historico->toArray(), function ($value){
                //return !empty($value);
                //})
            ];
        });
        //Arr::add($response, 'total',$total_tickets);
        $this->tickets = json_decode($response->toJson());

    }

    private function connectGlpi(){
        return Http::withHeaders([
            'Cookie'=> Glpi::all()->first()->cookie
        ])->withOptions([
            'verify' => false
        ]);
    }

    public function render()
    {
        return view('livewire.glpi-tickets');
    }
}
