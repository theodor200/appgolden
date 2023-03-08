<?php

namespace App\Http\Controllers;

use App\Imports\PedidosIngramImport;
use App\Models\PedidosIngram;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class ControllerIngram extends Controller
{

    public function index(){
        return view('Imports.upload');
    }

    public function upload(Request $request){
        $request->validate([
            'file-upload' => 'required|mimes:xlsx',
            'cliente' => 'required'
        ]);

        $file = $request->file('file-upload');
        $cliente = $request->input('cliente');

        Excel::import(new PedidosIngramImport($cliente), $file);
        return back()->with('message', 'Importacion de pedidos completada');
    }

    public function show(){
        $items = PedidosIngram::all();
        return view('Imports.show', compact('items'));
    }

}
