<?php

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
    return view('welcome');
});
// Customer ID 59f347a25da9bfa341c46130 (DHL)
//
// https://dcc.ext.hp.com/list/device?detail=1&displayLength=5&length=5&search=MXBCM9R1ZM&sequence=4&start=0&type=device
// https://dcc.ext.hp.com/ui/service-orders/list?customerId=5f34730888f6e10012fcbd0d&itemId=2c92808273b8db1a0173eff2a2c000b8&kits=false //DIVEMOTOR
// https://dcc.ext.hp.com/ui/service-orders/list?customerId=59f347a25da9bfa341c46130&itemId=2c92808579eecc0a0179f23d423900c4&kits=false //DHL
// https://dcc.ext.hp.com/list/customer/preSearch?search=MXBCM9R21X&sequence=1

//COKIEE DIVEMOTOR
//"AWSALB"=>"Rf8rhzw4McnRi6LLGG1M0WCwrG0Amxy6rZwVtCC9tO95HaLWMKUc/LgULKsV1IAPGML6IboF3rigyy7X2Ow1kgewwAa5HItFGAmzqMlVd4kqaPMPBI9W6a3b5Wbz;"
//"AWSALBCORS"=>"Rf8rhzw4McnRi6LLGG1M0WCwrG0Amxy6rZwVtCC9tO95HaLWMKUc/LgULKsV1IAPGML6IboF3rigyy7X2Ow1kgewwAa5HItFGAmzqMlVd4kqaPMPBI9W6a3b5Wbz;"
// "connect.sid"=>"s%3A7jAl7YhvtYgODaJg3qF-QG-XL5-ua_UR.a9TgHenJA%2Bum%2BESp5VwXF%2B9pQ0ynPNu7YsvbMqDgorM;"

//COKIEE DHL
//"AWSALB"=>"GXaIHMThFBEhZyZMI9krtPLi++ABc8o6hEFJAPY4ybMKBFcYv4BgsGmwkMaXz/os0X96ttxj/BGhu2FG7g8oy3nTZNsP+qOqGltLzUDlYucPlb3GpYMz+57AhKbB;"
//"AWSALBCORS"=>"GXaIHMThFBEhZyZMI9krtPLi++ABc8o6hEFJAPY4ybMKBFcYv4BgsGmwkMaXz/os0X96ttxj/BGhu2FG7g8oy3nTZNsP+qOqGltLzUDlYucPlb3GpYMz+57AhKbB;"
//"connect.sid"=>"s%3ADsPgwje02w33uAPuHJBIV-TIsZMwlw6b.leJrAu%2FP9CoH9vzzfu11TZm2EUe7FwSZ6DWOc5HfgYc;"

Route::get('/dcc', function (){

    dd(Http::withCookies([
        "AWSALB"=>env('AWSALB'),
        "AWSALBCORS"=>env('AWSALBCORS'),
        "connect.sid"=>env('CONNECTSID')
        ],"dcc.ext.hp.com")
        ->get(env('URL'))
        ->json()
    );

});
