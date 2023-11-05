<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StatusServicesOsa extends Component
{
    public $customerId;
    public $_id;
    public $itemId;
    public $servicesOsa;
    public $readyToLoad = false;
    public $sid;

    public function mount($customerId, $itemId){
        $sid = Site::where('customer_id',$customerId)->first();
        $this->sid=$sid['sid'];
        $this->customerId = $customerId;
        $this->itemId=$itemId;
    }

    public function loadServices()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $cases = $this->readyToLoad
            ? collect($this->getServices($this->customerId, $this->itemId, $this->sid))
            : [];
        return view('livewire.status-services-osa', compact('cases'));
    }

    /*public function test($customerId, $itemId){
        $data = Http::retry(10, 500)
            ->withCookies(["connect.sid"=>env('SID')],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/ui/service-orders/list?customerId='.$customerId.'&itemId='.$itemId.'&kits=false');
        return $data;
    }*/

    public function getServices($customerId, $itemId, $sid){
        $case_osa = [];
        $data = Http::retry(10, 500)
            ->withCookies(
                ["connect.sid"=>$sid],
                "dcc.ext.hp.com"
            )
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
