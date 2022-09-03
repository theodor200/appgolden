<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Sites extends Component
{
    public $sites;
    public $sid;
    public $customer_id;
    public $name;
    public $email;
    public $page;

    protected $rules = [
        'name' => 'required|unique:sites',
        'customer_id' => 'required|unique:sites',
        'email' => 'required|email',
        'sid' => 'required|unique:sites',
    ];

    public function mount(){
        $this->sites = Site::all();
    }

    public function obtenerDatos(){
        $this->customer_id='';
        $this->name='';

        $data = Http::withCookies([
            "connect.sid"=>$this->sid
        ],"dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0')
            ->json();
        if(isset($data['rows'][0]['name']) || isset($data['rows'][0]['_id'])){
            $this->name = $data['rows'][0]['name'];
            $this->customer_id = $data['rows'][0]['_id'];
            return true;
        }
       session()->flash('message', 'No se pudo obtener el ID del cliente desde DCC, por favor verificar que la clave SID sea valida.');
    }

    public function guardarSite()
    {
        $validatedData = $this->validate();
        Site::create($validatedData);
    }

    public function resetForm(){
        $this->sid='';
        $this->customer_id='';
        $this->name='';
        $this->email='';
    }

    public function render()
    {
        $view = view('livewire.sites');
        if($this->page=="show_page"){
            $view = view('livewire.sites-show');
        }

        return $view;
    }
}
