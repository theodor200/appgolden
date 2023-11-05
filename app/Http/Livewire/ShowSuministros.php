<?php

namespace App\Http\Livewire;

use App\Models\Site;
use GuzzleHttp\Promise;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
//use Illuminate\Http\Client\Pool;

class ShowSuministros extends Component
{
    private
        $type,
        $color,
        $model,
        $customer,
        $sid,
        $domain = 'dcc.ext.hp.com',
        $URI = 'https://dcc.ext.hp.com',
        $HTTP,
        $cookie,
        $respuesta;

    public
        $devices,
        $suministros;

    public function mount( Request $request){

        $this->type = $request->type;
        $this->color = $request->color;
        $this->model = $request->model;
        $this->customer = $request->customer;
        $this->HTTP = $this->HTTP_client(["base_uri"=>$this->URI]);
        $this->cookie = $this->HTTP_cookie(['connect.sid' => $this->sid], $this->domain);

        $this->sid = Site::where('customer_id',$this->customer)->first()->sid;
        //$this->devices = $this->getDevicesWithModel($this->model, $this->sid);
        //$this->suministros = $this->concurrent_request();
        //$this->test_suministro();
        dd($this->pedidosSuministros());

    }

    /*Extraer pedidos*/

    public function pedidosSuministros(){
        //Obtener todos los modelos
        $items = collect($this->getDevicesWithModel($this->model, $this->sid))->get('items');
        return collect($items)->map(function($item){
                    
                })->pluck('itemId')->all();

    }

    /*Fin de extraer pedidos*/

    /* Extraer datos de los suministros*/



   /* public function laravel_concurrent ($devices){
        $start_time = microtime(true);
        $items = $devices['items'];
        $responses = Http::pool(function (Pool $pool) use ($items) {
                        //$pool->get('http://localhost/first');
                        for($i=0; $i<=count($items)-1; $i++){
                            $customerId = $items[$i]['customerId'];
                            $deviceId = $items[$i]['itemId'];
                            $pool->withCookies([ "connect.sid" => $this->sid], "dcc.ext.hp.com")
                                ->retry(10,300)
                                ->get('https://dcc.ext.hp.com/usage/consumableLevels?customerId='.$customerId.'&deviceId='.$deviceId.'&endDate=08/26/2023&startDate=08/24/2023');
                        }
                });
        $terminate_time = microtime(true);
        $time_script = $terminate_time - $start_time;
        dd($time_script, $responses[0]->json());

    }
*/
    public function concurrent_request (){
        $start_time = microtime(true);

        $cookie =  $this->HTTP_cookie(['connect.sid' => $this->sid], $this->domain);
        $client = $this->HTTP_client(["base_uri"=>$this->URI, 'cookies' => $cookie, 'timeout' => -1]);

    // Initiate each request but do not block
        $promises = [
            '1' => $client->getAsync('/usage/4consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=4b73bbb39f0b4a04a8d393f36ff7e556&endDate=08/26/2023&startDate=07/01/2023'),
            '2' => $client->getAsync('/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=4b73bbb39f0b4a04a8d393f36ff7e556&endDate=08/26/2023&startDate=07/01/2023'),
            '3' => $client->getAsync('/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=2c9280857c77ae03017c7f26ea500013&endDate=08/26/2023&startDate=07/01/2023'),
            '4' => $client->getAsync('/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=cf80184f626f48a6a16370dc0d3bf2bf&endDate=08/26/2023&startDate=07/01/2023')
        ];

        $responses = Promise\Utils::settle($promises)->wait(true);


    // You can access each response using the key of the promise
        //echo $responses['1']['value']->getHeader('Content-Length')[0].'<br>';
        //echo $responses['2']['value']->getHeader('Content-Length')[0];
        //echo $responses['3']['value']->getHeader('Content-Length')[0];
        //echo $responses['4']['value']->getHeader('Content-Length')[0];
        $terminate_time = microtime(true);
        $time_script = $terminate_time - $start_time;
        dd($time_script,$promises );

    }
    public function test_suministro($devices){
        $start_time = microtime(true);

        $page_item = 5;
        $items = $devices['items'];
        $pages = array_chunk($items, $page_item);
        $HTTP = $this->HTTP_client(["base_uri"=>$this->URI]);
        $cookie = $this->HTTP_cookie(['connect.sid' => $this->sid], $this->domain);
        $count = count($items);
        $results = [];

        $promises = Arr::map($pages, function ($value, $key) use($HTTP, $cookie, $results){
                        return Arr::map($value, function ($val) use($HTTP, $cookie){
                                return $HTTP->getAsync('usage/consumableLevels?customerId='.$val['customerId'].'&deviceId='.$val['itemId'].'&endDate=08/26/2023&startDate=08/24/2023',['cookies' => $cookie]);
                        });
        });


	    //$body [] = $HTTP->get('https://dcc.ext.hp.com/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=4b73bbb39f0b4a04a8d393f36ff7e556&endDate=08/26/2023&startDate=07/01/2023',['cookies' => $cookie]);
        //$body [] = $HTTP->get('https://dcc.ext.hp.com/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=8d4767ad87d64119a0fba34fd3f06d42&endDate=08/26/2023&startDate=07/01/2023',['cookies' => $cookie]);
        //$body [] = $HTTP->get('https://dcc.ext.hp.com/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=2c9280857c77ae03017c7f26ea500013&endDate=08/26/2023&startDate=07/01/2023',['cookies' => $cookie]);
        //$body [] = $HTTP->get('https://dcc.ext.hp.com/usage/consumableLevels?clientName=jayhawk&customerId=AA38BFC2880D45D994D112FB022E65B1&deviceId=cf80184f626f48a6a16370dc0d3bf2bf&endDate=08/26/2023&startDate=07/01/2023',['cookies' => $cookie]);


        if (count($promises)>0){
            //$r = Promise\Utils::unwrap($promises[0]);
            $r = Promise\Utils::settle($promises[0])->wait();
            $body = json_decode($r[0]->getBody()->getContents(), true);
            echo count($promises);
        }else{
            echo 'No count';
        }
        //$prom = Promise\Utils::settle($promises[1])->wait();
        //$result = $prom->getBody()->getContents();
        $terminate_time = microtime(true);
        $time_script = $terminate_time - $start_time;

    }
    public function get_suministros($devices){
        $start_time = microtime(true);
        $items = $devices['items'];

        $HTTP = $this->HTTP_client(["base_uri"=>$this->URI]);
        $cookie = $this->HTTP_cookie(['connect.sid' => $this->sid], $this->domain);

        $requests = function () use ($HTTP, $items, $cookie)  {
                    for ($i = 0; $i < count($items); $i++) {
                        $customerId = $items[$i]['customerId'];
                        $deviceId = $items[$i]['itemId'];
                        yield function() use ($HTTP, $customerId, $deviceId, $cookie) {
                            return $HTTP->getAsync('usage/consumableLevels?customerId='.$customerId.'&deviceId='.$deviceId.'&endDate=08/26/2023&startDate=08/24/2023',
                                [
                                    'cookies' => $cookie,
                                    'timeout' => 5.0
                                ]
                            );
                        };
                    }
        };

        $pool = new Pool($HTTP, $requests(), [
                            'concurrency' => 15,
                            'fulfilled' => function (Response $response, $index) {
                                return $this->respuesta[] = json_decode($response->getBody()->getContents(), true);
                            },
                            'rejected' => function ( $reason, $index) {
                                echo 'Error'.$index.'<br>';
                            }
                        ]);
        $po = $pool->promise();
        $po->wait();
        $terminate_time = microtime(true);
        $time_script = $terminate_time - $start_time;

        dd($time_script, $this->respuesta);

    }
    /* Fin*/

    public function getDevicesWithModel($model, $sid){

        $start_time = microtime(true);
        $total_items = $this->getTotalDevicesModel(model: $this->model, sid: $sid);

        $devices = $this->HTTP_cursor(
            Guzzle_HTTP: $this->HTTP_client(["base_uri"=>$this->URI]),
            total_items: $total_items,
            display_items: 200,
            length_items: 200,
            start: 0,
            cookie: $this->HTTP_cookie(['connect.sid' => $sid], $this->domain),
            param_URI: "&search=model:".$this->model
        );

        $terminate_time = microtime(true);
        $time_script = $terminate_time - $start_time;

        $meta_data = ['all' => false, 'total_items' => $total_items, 'time_script' => $time_script, 'model' => $this->model];

        return [ "items" => $devices, "meta_data" => $meta_data ];

    }
    protected function HTTP_cursor(Client $Guzzle_HTTP, int $total_items, int $display_items, int $length_items, int $start, CookieJar $cookie, string $param_URI = ""): array{
        $page = round($length_items / $display_items);
        $count = $start;
        $promises = [];

        for($i=0; $i<=$page;$i++){
            $promises[] = $Guzzle_HTTP->getAsync('list/device?displayLength='.$display_items.'&length='.$length_items.'&start='.$count.'&type=device'.$param_URI,['cookies' => $cookie]);
            $count = $count + $length_items;
            if($count>=$total_items){
                break;
            }
        }
        return $this->HTTP_cursor_result(Promise\Utils::settle($promises)->wait(), 'rows');
    }
    protected function HTTP_client(array $options):Client{
        return new Client($options);
    }
    protected function HTTP_cookie(array $options, string $domain): CookieJar{
        return CookieJar::fromArray($options, $domain);
    }
    protected function HTTP_cursor_result(Array $promises,string $column): array{
        $data = Arr::map($promises, function ($value, $key) use ($column){
            return json_decode($value['value']->getBody()->getContents(), true)[$column];
        });
        return Arr::collapse($data);
    }
    public function getTotalDevicesModel(string $model, $sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?displayLength=1&length=1&search=model:'.$model.'&sequence=2&start=0&type=device')
            ->json();
        return $data['totalCount'];
    }
    public function get_model(){
        return $this->model;
    }

    public function render()
    {
        return view('livewire.show-suministros');
    }
}
