<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';
    protected $fillable = ['name', 'customer_id', 'email', 'sid'];

    public static function http($sid)
    {
        try {
            return Http::retry(10, 500)
                ->withCookies(["connect.sid" => $sid], "dcc.ext.hp.com")
                ->get('https://dcc.ext.hp.com/list/customer?displayLength=5&length=5&sequence=1&start=0')
                ->json();
        } catch (\Throwable $e) {
            //report($e);
            return $e->getMessage();
        }
    }
}
