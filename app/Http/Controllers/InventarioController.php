<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\InventarioModel;

class InventarioController extends BaseController{
    public function index(){
        $data = InventarioModel::all();
        return response($data);
    }

    public function show($id){
        $data = InventarioModel::where('id', $id)->get();

        if($data && count($data) > 0){
            return response ($data);
        }else{
            return response('Auto no encontrado');
        }
    }

    public function store(Request $request){
        $data = new InventarioModel; 

        if($request->input('modelo')){
            $data->modelo = $request->input('modelo');
        }else{
            return response('Modelo debe contener valor');
        }
        
        if($request->input('tipo')){
            $data->tipo = $request->input('tipo');
        }else{
            return response('Tipo debe contener valor');
        }

        if($request->input('tipo')!='sedan' && $request->input('tipo')!='motocicleta'){
            return response('Tipo debe ser sedan o motocicleta');
        }
                
        if($request->input('motor')){
            $data->motor = $request->input('motor');
        }else{
            return response('motor debe contener valor');
        }
        
        $data->save();

        return response('Successful insert');
    }

    public function update(Request $request, $id){
        $data = InventarioModel::where('id',$id)->first();

        if($request->input('modelo')){
            $data->modelo = $request->input('modelo');
        }
        
        if($request->input('tipo')){
            $data->tkpo = $request->input('tipo');
        }

        if($request->input('tipo') && $request->input('tipo')!='sedan' && $request->input('tipo')!='motocicleta'){
            return response('Tipo debe ser sedan o motocicleta');
        }
                
        if($request->input('motor')){
            $data->motor = $request->input('motor');
        }

        $data->save();
    
        return response('Successful update');
    }

    public function destroy($id){
        
        $data = InventarioModel::where('id',$id)->first();

        if ($data && count($data) > 0){
            $data->delete();
        } else {
            return response('Auto no encontrado');
        }



        return response('Successful delete');
    }
}