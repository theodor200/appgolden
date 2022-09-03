<?php

namespace App\Http\Livewire;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowDevices extends Component
{
    public $name_client;
    public $devices;
    protected $customer;
    protected $customer_id;

    public function mount( Request $request){
        $sid = Site::where('customer_id',$request->customer)->first();
        $this->name_client = $this->getNameClient($sid['sid']);
        $this->devices = $this->getDevicesWithModel($request->model, $sid['sid']);

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
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?search='.$model.'&start=0&type=device')
            ->json();
        return $data;
    }
}
