<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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
        //$this->models_devices = $this->getCountModelDevice($sid['sid']);
        $this->models_devices = Arr::map($this->getCountModelDevice($sid['sid']), function ($value, $key){
            switch ($value['value'])
            {
                case Str::contains($value['value'], ['E72535']):
                    $value['type']='a3';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E72525']):
                    $value['type']='a3';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E82550']):
                    $value['type']='a3';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E82560']):
                    $value['type']='a3';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E77830']):
                    $value['type']='a3';
                    $value['color']='color';
                    return $value;

                case Str::contains($value['value'], ['E78330']):
                    $value['type']='a3';
                    $value['color']='color';
                    return $value;

                case Str::contains($value['value'], ['T130']):
                    $value['type']='plotter';
                    $value['color']='color';
                    return $value;

                case Str::contains($value['value'], ['E40040']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E50145']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E52645']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E62655']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['M428FDW']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E60155']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E60165']):
                    $value['type']='a4';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['E58650']):
                    $value['type']='a4';
                    $value['color']='color';
                    return $value;

                case Str::contains($value['value'], ['E55040']):
                    $value['type']='a4';
                    $value['color']='color';
                    return $value;

                case Str::contains($value['value'], ['E57540']):
                    $value['type']='a4';
                    $value['color']='color';
                    return $value;

                case Str::contains($value['value'], ['FX890']):
                    $value['type']='matricial';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['FX890']):
                    $value['type']='matricial';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['FX-2190']):
                    $value['type']='matricial';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['DFX-9000']):
                    $value['type']='matricial';
                    $value['color']='black';
                    return $value;

                case Str::contains($value['value'], ['TM-U220A']):
                    $value['type']='matricial';
                    $value['color']='black';
                    return $value;

                default:
                    $value['type']= null;
                    $value['color']= null;
                    return $value;
            }
            //return $value;
        });

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
