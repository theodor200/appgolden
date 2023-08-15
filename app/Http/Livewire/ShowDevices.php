<?php

namespace App\Http\Livewire;
use App\Models\Site;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Promise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;

class ShowDevices extends Component
{
    public $name_client;
    public $devices;
    protected $customer;
    protected $model;
    protected $customer_id;
    private $domain =  'dcc.ext.hp.com';
    private $URI = 'https://dcc.ext.hp.com';

    public function mount( Request $request){
        $sid = Site::where('customer_id',$request->customer)->first();
        $this->name_client = $this->getNameClient($sid['sid']);
        if($request->model=='all'){
            $this->devices = $this->getAllDevices($sid['sid']);
        }else{
            $this->model = $request->model;
            $this->devices = $this->getDevicesWithModel($this->model, $sid['sid']);
        }
    }

    public function render()
    {
        return view('livewire.show-devices')
            ->layout('layouts.app');
    }

    public function getNameClient($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0')
            ->json();
        return $data['rows'][0]['name'];
    }

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

    public function getAllDevices($sid): array{
        $start_time = microtime(true);
        $total_items = $this->getTotalDevices($sid);

        $devices = $this->HTTP_cursor(
                                        Guzzle_HTTP: $this->HTTP_client(["base_uri"=>$this->URI]),
                                        total_items: $total_items,
                                        display_items: 200,
                                        length_items: 200,
                                        start: 0,
                                        cookie: $this->HTTP_cookie(['connect.sid' => $sid], $this->domain)
        );

        $terminate_time = microtime(true);
        $time_script = $terminate_time - $start_time;

        $meta_data = ['all' => true, 'total_items' => $total_items, 'time_script' => $time_script];

        return [ "items" => $devices, "meta_data" => $meta_data ];
    }

    public function getTotalDevices($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?displayLength=5&length=5&sequence=6&start=20&type=device')
            ->json();
        return $data['totalCount'];
    }

    public function getTotalDevicesModel(string $model, $sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?displayLength=1&length=1&search=model:'.$model.'&sequence=2&start=0&type=device')
            ->json();
        return $data['totalCount'];
    }

    protected function HTTP_client(array $options):Client{
        return new Client($options);
    }
    protected function HTTP_cookie(array $options, string $domain): CookieJar{
        return CookieJar::fromArray($options, $domain);
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
    protected function HTTP_cursor_result(Array $promises,string $column): array{
        $data = Arr::map($promises, function ($value, $key) use ($column){
                    return json_decode($value['value']->getBody()->getContents(), true)[$column];
                });
        return Arr::collapse($data);
    }
}
