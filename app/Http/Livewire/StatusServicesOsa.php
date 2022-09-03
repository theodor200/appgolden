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
            $item = $data->json();
            if(isset($item['rows'])){
                $case_osa=collect($item);
                $case_osa->put('count',count($item['rows']));

                $rows = collect($item['rows']);
                //$case_osa->put('open', $rows->where('open', true)->count());
                $case_osa->put('open', 100);
                $case_osa->put('close', $rows->where('open', false)->count());
            }
        }elseif ($data->failed()){
            $case_osa['Failed'];
        }
        return $case_osa;
    }
}
