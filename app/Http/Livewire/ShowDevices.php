<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowDevices extends Component
{
    public $name_client;
    public $devices;

    public function mount( Request $request){
        $this->name_client = $this->getNameClient();
        $this->devices = $this->getDevicesWithModel($request->data);
    }

    public function render()
    {
        return view('livewire.show-devices')
            ->layout('layouts.app');
    }

    public function getNameClient(){
        $data = Http::withCookies([
            "connect.sid"=>env('SID')
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0')
            ->json();
        return $data['rows'][0]['name'];
    }

    public function getDevicesWithModel($request){
        $data = Http::withCookies([
            "connect.sid"=>env('SID')
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/device?search='.$request.'&start=0&type=device')
            ->json();
        return $data;
    }
}
