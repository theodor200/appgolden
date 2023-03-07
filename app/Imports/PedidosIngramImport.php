<?php

namespace App\Imports;

use App\Models\PedidosIngram;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\DomCrawler\Crawler;


class PedidosIngramImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $datos = $this->pedido($row['cliente'],$row['serie'],$row['nota_venta']);

        //Modelo pedido_ingram ACTUALIZA un registro si encuentra una nota de venta registrada previamente, si no lo encuentra, creea un nuevo registro

        return PedidosIngram::updateOrCreate(
                ['order_dcc' => $row['order_dcc']],
                [
                    'cliente' => $row['cliente'],
                    'nota_venta' => $row['nota_venta'],
                    'serie' => $row['serie'],
                    'numero_modelo' => $row['numero_modelo'],
                    'modelo' => $row['modelo'],
                    'order_dcc' => $row['order_dcc'],
                    'order_estado_dcc' => $row['order_estado_dcc'],
                    'order_tipo_dcc' => $row['order_tipo_dcc'],
                    'numero_suministro' => $row['numero_suministro'],
                    'suministro' => $row['suministro'],
                    'cliente_dcc' => $row['cliente_dcc'],
                    'site_dcc' => $row['site_dcc'],

                    //'nota_venta'=> $datos['nota_venta'], //Esta fila muestra la nota de venta de la web de Ingram al hacer el Scrap
                    'guia_remision'=> $datos['guia_remision'],
                    'procesado'=> $datos['procesado'],
                    'preparado'=> $datos['preparado'],
                    'transito'=> $datos['transito'],
                    'zona'=> $datos['zona'],
                    'entregado'=> $datos['entregado'],
                    'digitalizado'=> $datos['digitalizado'],
                    'rechazado'=> $datos['rechazado'],
                    'observaciones'=> $datos['observaciones']
                ]
            );
        //Fin de modelo ingram
    }

    public function pedido($cliente, $serie, $nota_venta){
        if($nota_venta == ''){
            $nota_venta = 0;
        }
        //Obtemos los datos de la web de Ingram segun la nota venta
        $datos_nota_venta = Http::withCookies([
            "ASP.NET_SessionId"=>'zyyaffjxctv20w1w24ourc0f'],
            "www.ingrammicromps.com")
            ->get('https://www.ingrammicromps.com/hpmps/consulta_estado2.aspx?ndoc='.$nota_venta.'&tdoc=05')
            ->body();
        //Fin de obtener los datos de ingram

        //Extraemos los datos y fechas del proceso de despacho y recepcion del suministro
        $extraer = new Crawler($datos_nota_venta);
        $cliente = $cliente;
        $serie = $serie;

        $count_col = $extraer->filter('table > tr')->eq(1)->children()->count();//En algunos casos son 9 columnas una llamada ZONA adicional
        $nota_venta = $extraer->filterXPath('//div[@class="panel-body"]')->eq(0)->children()->eq(0)->children()->eq(2)->text();
        if($count_col == 8){
            $guia_remision = $extraer->filter('table > tr')->eq(1)->children()->eq(0)->text();
            $procesado = $extraer->filter('table > tr')->eq(1)->children()->eq(1)->text();
            $preparado = $extraer->filter('table > tr')->eq(1)->children()->eq(2)->text();
            $transito = $extraer->filter('table > tr')->eq(1)->children()->eq(3)->text();
            $entregado = $extraer->filter('table > tr')->eq(1)->children()->eq(4)->text();
            $zona = null;
            $digitalizado = $extraer->filter('table > tr')->eq(1)->children()->eq(5)->text();
            $rechazado = $extraer->filter('table > tr')->eq(1)->children()->eq(6)->text();
            $observaciones = $extraer->filter('table > tr')->eq(1)->children()->eq(7)->text();
        }else{
            $guia_remision = $extraer->filter('table > tr')->eq(1)->children()->eq(0)->text();
            $procesado = $extraer->filter('table > tr')->eq(1)->children()->eq(1)->text();
            $preparado = $extraer->filter('table > tr')->eq(1)->children()->eq(2)->text();
            $transito = $extraer->filter('table > tr')->eq(1)->children()->eq(3)->text();
            $zona = $extraer->filter('table > tr')->eq(1)->children()->eq(4)->text();
            $entregado = $extraer->filter('table > tr')->eq(1)->children()->eq(5)->text();
            $digitalizado = $extraer->filter('table > tr')->eq(1)->children()->eq(6)->text();
            $rechazado = $extraer->filter('table > tr')->eq(1)->children()->eq(7)->text();
            $observaciones = $extraer->filter('table > tr')->eq(1)->children()->eq(8)->text();
        }




        //Fin de extraer los datos de fechas de la web de ingram

        return [
            'cliente' => $cliente,
            'serie' => $serie,
            'nota_venta' => $nota_venta,
            'guia_remision'=> $guia_remision,
            'procesado'=> $procesado,
            'preparado'=> $preparado,
            'transito'=> $transito,
            'zona'=> $zona,
            'entregado'=> $entregado,
            'digitalizado'=> $digitalizado,
            'rechazado'=> $rechazado,
            'observaciones'=> $observaciones
        ];
    }

}
