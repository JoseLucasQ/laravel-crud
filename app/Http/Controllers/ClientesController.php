<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use Image;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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
        $cliente->rg = $request->rg;
        $cliente->email = $request->email;
        $cliente->telefone = $request->numero;
        $cliente->endereço = $request->endereço;
        
        if($request->photo !== 'image.png'){
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(200, 200);
            $upload_path = public_path()."/upload/";
            $img->save($upload_path.$name);
            $cliente->foto = $name;

        }else{
            $cliente->foto = "image.png";
        }

        $cliente->save();
        Mail::to($request->email)->send(new TestMail());
    }

    public function get_edit_cliente($id){
        $cliente = Clientes::find($id);
        return response()->json([
            'cliente' => $cliente
        ],200);
    }

    public function update_cliente(Request $request, $id){
        $cliente = Clientes::find($id);

        $cliente->nome = $request->nome;
        $cliente->rg = $request->rg;
        $cliente->email = $request->email;
        $cliente->telefone = $request->numero;
        $cliente->endereço = $request->endereço;
        if($cliente->foto!=$request->photo){
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(200, 200);
            $upload_path = public_path()."/upload/";
            $image = $upload_path. $cliente->foto;
            $img->save($upload_path.$name);
            if(file_exists($image)){
                @unlink($image);
            }
        }else{
            $name = $cliente->foto;
        }
        $cliente->foto = $name;

        $cliente->save();
    }

    public function delete_cliente($id){
        $cliente = Clientes::findOrFail($id);
        $image_path = public_path()."/upload/";
        $image = $image_path. $cliente->photo;
        if(file_exists($image)) {
            @unlink($image);
        }
        $cliente->delete();
    }

}
