<?php

namespace App\Http\Controllers;

use App\Models\ReportDevice;
use App\Models\ReportSite;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportDevicesController extends Controller
{
    public function store(){
        $devices = collect([]);
        Site::all()->map(function ($item){
                return $item->sid;
        })->each(function ($sid) use ($devices){
            $items = Http::retry(10, 500)
                ->withCookies(
                    ["connect.sid"=>$sid],
                    "dcc.ext.hp.com")
                ->get('https://dcc.ext.hp.com/list/device?displayLength=99999&length=99999&sequence=6&start=0&type=device')
                ->json();
            $devices->push($items['rows']);
        });
       return $devices->map(function ($items){
            return $items[0];
        });
        //return $devices;
    }
}
