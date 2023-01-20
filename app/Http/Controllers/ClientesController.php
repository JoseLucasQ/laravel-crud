<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function get_all_clientes(){
        $clientes = Clientes::all();
        return response()->json([
            'clientes' => $clientes
        ],200);
    }

    public function add_cliente (Request $request){
        $cliente = new Clientes();
        $cliente->nome = $request->nome;

        $cliente->save();
    }

}
