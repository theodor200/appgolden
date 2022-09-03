<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowModels extends Component
{
    public $total_devices;
    public $name_client;
    public $models_devices;
    protected $customer_id;

    public function mount($customer){
        $sid = Site::where('customer_id',$customer)->first();
        $this->customer_id = $sid['customer_id'];
        $this->total_devices = $this->getTotalDevices($sid['sid']);
        $this->name_client = $this->getNameClient($sid['sid']);
        $this->models_devices = $this->getCountModelDevice($sid['sid']);
    }

    public function render()
    {
        return view('livewire.show-models')
            ->layout('layouts.app');
    }

    public function getId(){
        return $this->customer_id;
    }

    public function getTotalDevices($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?displayLength=5&length=5&sequence=6&start=20&type=device')
            ->json();
        return $data['totalCount'];
    }

    public function getNameClient($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0')
            ->json();
        return $data['rows'][0]['name'];
    }

    public function getCountModelDevice($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/aggregate?countThreshold=600&property=family&type=device')
            ->json();
        return $data['docs'];
    }
}
