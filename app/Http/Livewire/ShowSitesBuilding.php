<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Site;
use Illuminate\Support\Facades\Http;

class ShowSitesBuilding extends Component
{

    public $items, $total;
    protected $customer_id;

    public function mount(){
        $sid = Site::where('customer_id','5f8dcb83eb73a0001299cdac')->first();
        $this->customer_id = $sid['customer_id'];
        $this->items = $this->getSitesBuilding($sid['sid']);
        $this->total = $this->getTotal($sid['sid']);
    }

    private function getSitesBuilding($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/site?displayLength=50&length=50&sequence=0&start=301&type=site')
            ->json();
        return collect($data['rows']);
    }

    private function getTotal($sid){
        $data = Http::withCookies([
            "connect.sid"=>$sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/site?displayLength=1&length=1&sequence=0&start=0&type=site')
            ->json();
        return collect($data['totalCount']);
    }

    public function render()
    {        
        return view('livewire.show-sites-building')
        ->layout('layouts.app');
    }
}
