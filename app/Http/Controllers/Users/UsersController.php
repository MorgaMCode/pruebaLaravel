<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
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

            $data =  User::getListUserDelivery($request['nombre']);

           return response()->json(['messages' => 'consultado correctamente','data'=> $data],200);

        } catch (\Exception $e) {
            return response($e);
        }
    }


}
