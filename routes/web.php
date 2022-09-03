<?php

use App\Http\Livewire\ShowModels;
use App\Http\Livewire\ShowDevices;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
    //return view('welcome');
});

// Customer ID 59f347a25da9bfa341c46130 (DHL)
//
// https://dcc.ext.hp.com/list/device?detail=1&displayLength=5&length=5&search=MXBCM9R1ZM&sequence=4&start=0&type=device
// https://dcc.ext.hp.com/ui/service-orders/list?customerId=5f34730888f6e10012fcbd0d&itemId=2c92808273b8db1a0173eff2a2c000b8&kits=false //DIVEMOTOR
// https://dcc.ext.hp.com/ui/service-orders/list?customerId=59f347a25da9bfa341c46130&itemId=2c92808579eecc0a0179f23d423900c4&kits=false //DHL
// https://dcc.ext.hp.com/list/customer/preSearch?search=MXBCN3R45X&sequence=1
// https://dcc.ext.hp.com/ui/login

//COKIEE DIVEMOTOR
//"AWSALB"=>"Rf8rhzw4McnRi6LLGG1M0WCwrG0Amxy6rZwVtCC9tO95HaLWMKUc/LgULKsV1IAPGML6IboF3rigyy7X2Ow1kgewwAa5HItFGAmzqMlVd4kqaPMPBI9W6a3b5Wbz;"
//"AWSALBCORS"=>"Rf8rhzw4McnRi6LLGG1M0WCwrG0Amxy6rZwVtCC9tO95HaLWMKUc/LgULKsV1IAPGML6IboF3rigyy7X2Ow1kgewwAa5HItFGAmzqMlVd4kqaPMPBI9W6a3b5Wbz;"
// "connect.sid"=>"s%3A7jAl7YhvtYgODaJg3qF-QG-XL5-ua_UR.a9TgHenJA%2Bum%2BESp5VwXF%2B9pQ0ynPNu7YsvbMqDgorM;"

//COKIEE DHL

//AWSALB=K9M15+zKPi1WvXKcOJrnK7UiNG5MEYcVz3tDt4SdnSiugPsdIko7XDVnUaVuhhQUsX85W+0dJXnApcWWNS6pReZpQKvH69jcHGmeX2+kPXEh3Vj0WzaVcxDa23KZ;
//AWSALBCORS=K9M15+zKPi1WvXKcOJrnK7UiNG5MEYcVz3tDt4SdnSiugPsdIko7XDVnUaVuhhQUsX85W+0dJXnApcWWNS6pReZpQKvH69jcHGmeX2+kPXEh3Vj0WzaVcxDa23KZ;
//CONNECTSID=s%3AlKJg5QNG5Y6Tzdd-lblGMybkTcgwtR0S.vjcANQEvCNAWYcbNKPMo4J6zhhFsL20gY6%2BSuIbGSJQ;
//https://dcc.ext.hp.com/list/device?displayLength=5&length=5&sequence=6&start=20&type=device ->Lista de equipos con paginación
//https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0 -> URL de inicio
//https://dcc.ext.hp.com/list/device/preSearch?search=MXBCM9W09K&sequence=1 --> URL de busqueda por serie o letras de serie
//https://dcc.ext.hp.com/ui/service-orders/list?customerId=5f34730888f6e10012fcbd0d&itemId=2c92808273b8db1a0173eff2e40000c2&kits=false --> URL para ver las ordenes de servicio
Route::get('/dcc', function (){
    $data = Http::withCookies([
        "connect.sid"=>env('SID')],
        "dcc.ext.hp.com")
        ->get('https://dcc.ext.hp.com/ui/login/status')
        ->json();
    return $data;
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/devices/{data}', ShowDevices::class )->name('devices');
    Route::get('/models', ShowModels::class )->name('models');
    Route::get('/sites', \App\Http\Livewire\Sites::class)->name('sites');
});
