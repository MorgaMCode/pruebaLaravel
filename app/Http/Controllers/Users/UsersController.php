<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function listDelivery(Request $request){
        $v = Validator::make($request->all(),[
            'nombre'=>'string'

        ]);
        if ($v->fails()) {
            return response($v->errors());
        }
        try {
            $usersDelivery = DB::table('yap_datos.users as ydu')
           ->select('ydu.id','ydu.nombre','ydud.fotoMini')
           ->leftJoin('yap_datos.usersDeliverys as ydud','ydud.idUser','ydu.id')
           ->where('tipo',41)
           ->get();

           if($request['nombre'] )
           {
               $filterDeliverys  = collect($usersDelivery)->filter(function ($item) use ($request) {
                if( str_contains(Strval(strtolower($item->nombre )), strtolower($request['nombre'])) ) return $item;
                })->values();
                return response()->json(['messages' => 'consultado correctamente','data'=>$filterDeliverys],200);
           }
           return response()->json(['messages' => 'consultado correctamente','data'=>$usersDelivery],200);

        } catch (\Exception $e) {
            return response($e);
        }
    }


}
