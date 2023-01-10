<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDevice extends Model
{
    use HasFactory;

    protected $table='report_devices';
    protected $fillable = [
        'item_id','customer_id','serial','model','partnumber','site','customer_name'
    ];


}
