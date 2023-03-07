<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosIngram extends Model
{
    use HasFactory;

    protected $table = 'ingram';
    protected $fillable = [
        'cliente',
        'nota_venta',
        'serie',
        'numero_modelo',
        'modelo',
        'order_dcc',
        'order_estado_dcc',
        'order_tipo_dcc',
        'numero_suministro',
        'suministro',
        'cliente_dcc',
        'site_dcc',
        'guia_remision',
        'procesado',
        'preparado',
        'transito',
        'zona',
        'entregado',
        'digitalizado',
        'rechazado',
        'observaciones'
    ];
}
