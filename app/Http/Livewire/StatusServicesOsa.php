<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StatusServicesOsa extends Component
{
    public $customerId;
    public $itemId;
    public $servicesOsa;
    public $readyToLoad = false;

    public function mount($customerId, $itemId){
        $this->customerId=$customerId;
        $this->itemId=$itemId;
        //$this->servicesOsa=$this->getServices($this->customerId,$this->itemId);
    }

    public function loadServices()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $cases = $this->readyToLoad
            ? collect($this->getServices($this->customerId, $this->itemId))
            : [];
        return view('livewire.status-services-osa', compact('cases'));
        //return view('livewire.status-services-osa',compact('case_osa'));
    }

    public function test($customerId, $itemId){
        $data = Http::retry(10, 500)
            ->withCookies(["connect.sid"=>env('SID')],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/ui/service-orders/list?customerId='.$customerId.'&itemId='.$itemId.'&kits=false');
        return $data;
    }

    public function getServices($customerId, $itemId){
        $case_osa = [];
        $data = Http::retry(10, 500)
            ->withCookies(["connect.sid"=>env('SID')],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/ui/service-orders/list?customerId='.$customerId.'&itemId='.$itemId.'&kits=false');

        if($data->successful()){
            if(isset($data['rows'])){
                $case_osa=collect($data);
                $case_osa->put('count',count($data['rows']));

                $rows = collect($data['rows']);
                $case_osa->put('open', $rows->where('open', true)->count());
                $case_osa->put('close', $rows->where('open', false)->count());
            }
        }elseif ($data->failed()){
            $case_osa['Failed'];
        }
        return $case_osa;
    }
}
