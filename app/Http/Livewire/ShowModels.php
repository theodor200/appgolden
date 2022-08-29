<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowModels extends Component
{
    public $total_devices;
    public $name_client;
    public $models_devices;

    public function mount(){
        $this->total_devices = $this->getTotalDevices();
        $this->name_client = $this->getNameClient();
        $this->models_devices = $this->getCountModelDevice();
    }

    public function render()
    {
        return view('livewire.show-models')
            ->layout('layouts.app');
    }

    public function getTotalDevices(){
        $data = Http::withCookies([
            "connect.sid"=>env('SID')
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?displayLength=5&length=5&sequence=6&start=20&type=device')
            ->json();
        return $data['totalCount'];
    }

    public function getNameClient(){
        $data = Http::withCookies([
            "connect.sid"=>env('SID')
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0')
            ->json();
        return $data['rows'][0]['name'];
    }

    public function getCountModelDevice(){
        $data = Http::withCookies([
            "connect.sid"=>env('SID')
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/aggregate?countThreshold=600&property=family&type=device')
            ->json();
        return $data['docs'];
    }
}
