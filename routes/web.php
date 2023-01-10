<?php

use App\Http\Controllers\ReportDevicesController;
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

//https://dcc.ext.hp.com/ui/login/status
//https://dcc.ext.hp.com/list/device?displayLength=99999&length=99999&sequence=6&start=0&type=device ->Lista de equipos con paginación
//https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0 -> URL de inicio
//https://dcc.ext.hp.com/list/device/preSearch?search=MXBCM9W09K&sequence=1 --> URL de busqueda por serie o letras de serie
//https://dcc.ext.hp.com/ui/service-orders/list?customerId=5e456077e17c9d001b8d9167&itemId=046a825575f7410ca07b96d8d2f74280&kits=false --> URL para ver las ordenes de servicio
Route::get('/dcc', function (){
    $items = Http::withCookies([
        "connect.sid"=>'s%3A2iYRJaTrUSGD56zVg9auwRBrkHR3_L5t.Vlf%2FUsz%2Fqq%2BkcmqJBqWR6KSftOg96%2BZ2wnadvihr6Cc'],
        "dcc.ext.hp.com")
        //->get('https://dcc.ext.hp.com/ui/service-orders/list?customerId=5e456077e17c9d001b8d9167&itemId=2c9280826d02d74b01705e12992b3190&kits=false')
        ->get('https://dcc.ext.hp.com/list/device?displayLength=99999&length=99999&sequence=6&start=0&type=device')
        ->json();
    $devices = collect($items['rows']);
    $report = $devices->map(function ($item, $key) {
        $data=collect([]);

        $itemId=$item['itemId'];
        $customerId=$item['customerId'];

        $data->put('itemId',$itemId);
        $data->put('customerId',$customerId);
        $data->put('serial', $item['dataMap']['serialNr']);
        $data->put('model',$item['dataMap']['model']);
        $data->put('partNumber',$item['dataMap']['productNr']);
        $data->put('site',$item['dataMap']['site']);
        $data->put('customerName',$item['dataMap']['customerName']);

        /*$services=Http::withCookies([
            "connect.sid"=>'s%3A2iYRJaTrUSGD56zVg9auwRBrkHR3_L5t.Vlf%2FUsz%2Fqq%2BkcmqJBqWR6KSftOg96%2BZ2wnadvihr6Cc'],
            "dcc.ext.hp.com")
            ->get('https://dcc.ext.hp.com/ui/service-orders/list?customerId='.$customerId.'&itemId='.$itemId.'&kits=false')
            ->json();
        $data->put('services', $services['rows']);*/

        return $data;
    });

    return $report->all();
});

Route::get('/report_devices', [ReportDevicesController::class,'store'])->name('report_devices.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/sites', \App\Http\Livewire\Sites::class)->name('sites');
    Route::get('/models/{customer}', ShowModels::class )->name('models');
    Route::get('/devices/{model}/{customer}', ShowDevices::class )->name('devices');
});
