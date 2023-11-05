<?php

namespace App\Http\Controllers;

use App\Models\Glpi;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use function Laravel\Prompts\text;

class ControllerGlpi extends Controller
{
    private function connectGlpi(){
        return Http::withHeaders([
            'Cookie'=> Glpi::all()->first()->cookie
        ])->withOptions([
            'verify' => false
        ]);
    }

    private function ticketAsignacionHistorico($ticket){

        $historico = $this->connectGlpi()->get('https://mesadeservicios.intercorpretail.pe/glpi/ajax/common.tabs.php?_target=/glpi/front/ticket.form.php&_itemtype=Ticket&_glpi_tab=Log$1&id='.$ticket);
        $crawler_historico = new Crawler($historico->body());
        $collect_historico = collect($crawler_historico->filter('tbody')->children());

        return $collect_historico->map( function ($html, $id ){
            $DOM = new Crawler($html);
            $contains = $DOM->children()->eq(4)->text();
            if( Str::contains ($contains, [
                'Agregar un vinculo con un articulo: N3-IRM-Soporte de Impresoras (219)',
                'Agregar un vinculo con un articulo: Theodor Cardenas Huacause (11488)',
                'Agregar un vinculo con un articulo: Cardenas Huacause Theodor (11488)',
                'Agregar un vinculo con un articulo: Daive Laime Antay (7706)',
                'Agregar un vinculo con un articulo: Laime Antay Daive (7706)',
                'Agregar un vinculo con un articulo: Piero Enriquez (2835)',
                'Agregar un vinculo con un articulo: Enriquez Piero (2835)',
                'Agregar un vinculo con un articulo: Ricardo Iparraguirre Ochante (7705)',
                'Agregar un vinculo con un articulo: Iparraguirre Ochante Ricardo (7705)']) ){

                return [
                    'id'=>$DOM->children()->eq(0)->text(),
                    'fecha'=>$DOM->children()->eq(1)->text(),
                    'usuario'=>$DOM->children()->eq(2)->text(),
                    'detalle'=>$DOM->children()->eq(4)->text(),
                ];

            }

        });
    }
    public function listTickets(){
        $response = $this->connectGlpi()->get('https://mesadeservicios.intercorpretail.pe/glpi/ajax/search.php?action=display_results&searchform_id=search_1288636887&itemtype=Ticket&glpilist_limit=1000&sort%5B%5D=1&order%5B%5D=ASC&is_deleted=0&as_map=0&browse=0&criteria%5B0%5D%5Blink%5D=AND&criteria%5B0%5D%5Bfield%5D=12&criteria%5B0%5D%5Bsearchtype%5D=equals&criteria%5B0%5D%5Bvalue%5D=notold&criteria%5B1%5D%5Blink%5D=AND&criteria%5B1%5D%5Bfield%5D=8&criteria%5B1%5D%5Bsearchtype%5D=equals&criteria%5B1%5D%5Bvalue%5D=219&savedsearches_id=1679&start=0');
        $crawler = new Crawler($response->body());
        $total_tickets = $crawler->filter('tbody')->children()->count();
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

        Arr::add($response, 'total',$total_tickets);
        return '<pre>'.json_encode($response, JSON_PRETTY_PRINT).'</pre>';
    }
}
