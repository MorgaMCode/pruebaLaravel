<?php

namespace App\Http\Controllers\Ordenes;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class OrdenesController extends Controller
{
    public  function getList(Request $request,$id){
       try {
        $request['id']=$id;
        $v = Validator::make($request->all(),[
            'id' =>'required|integer',
            'chatActivo'=>['nullable',Rule::in([0, 1])],
            'estado'=>['nullable',Rule::in([11,12,13,14,15]),],
            'tipoPedido'=>['nullable',Rule::in([1,2,3])]

        ],[
            '*.required' =>"el campo :attribute es obligatorio",
            'id.integer' =>"el campo :attribute debe ser un numero entero",
            'buscar.string' =>'el campo :attribute debe ser un texto',
            'chatActivo.in'=>'el campo :attribute debe ser 0 o 1',
            'tipoPedido.in'=>'el campo :attribute debe ser 1=Domicilios 2=Recoger 3=Mesa',
            'estado.in'=>'el campo :attribute debe ser 11=Creado 12=Aceptado 13=Preparado/Alistado 14=Empacado 15=Enviado',
        ]);
        if ($v->fails()) {
            return response()->json([
               'message' => $v->errors()
            ],400);
        }

        $orders = DB::table('yap_restaurantes.ordenes as o')
        ->select('o.id','o.valorFinal','o.entregaBarrio','o.estado','o.tipoPedido','od.valorDomicilio')
        ->selectRaw("(date_format(o.entregaHora, '%h:%i %p'))as entregaHora")
        ->selectRaw("(date_format(o.createdAt, '%h:%i %p'))as horaCreado")
        ->selectRaw("(date_format(o.entregaHora, '%Y-%m-%d'))as dia")
        ->selectRaw("(select count(*) from ordenesProductos as op where op.idOrden = o.id) as cantidadProductos")
        //->selectRaw("(select if(count(*)>0,1,0) from yap_datos.ordenesChats as doc where doc.idOrdenRestaurante = o.id) as tieneChat")
        ->selectRaw("1 as tieneChat")
        ->leftJoin('yap_restaurantes.ordenesDatos as od','od.idOrden','o.id')
        ->whereIn('o.estado',[11,12,13,14,15])
        ->when(isset($request->tipoPedido),function ($q) use($request){
            return $q->where('tipoPedido',$request->query('tipoPedido'));
        })
        ->when(isset($request->estado),function ($q) use($request){
            return $q->where('estado',$request->estado);
        })
        ->when(isset($request->chatActivo),function ($q) use($request){
            return $q->having('tieneChat',$request->chatActivo);
        })
        ->when(isset($request->buscar),function ($q) use($request){
            return $q->having('id', 'like' ,"%$request->buscar%")
            ->orHaving('valorFinal', 'like' ,"%$request->buscar%")
            ->orHaving('entregaBarrio', 'like' ,"%$request->buscar%")
            ->orHaving('entregaHora', 'like' ,"%$request->buscar%")
            ->orHaving('valorDomicilio', 'like' ,"%$request->buscar%")
            ->orHaving('cantidadProductos', 'like' ,"%$request->buscar%")
            ->orHaving('horaCreado', 'like' ,"%$request->buscar%");
        })
        ->get();

        $data = [];
        $now = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::parse($now)->addDay()->format('Y-m-d');

        $dias = $orders->sortByDesc('dia')->pluck('dia')->unique();

        foreach ($dias as $value){

            if ( $value == $now ) {
                $day = 'HOY';
            }else if ($value == $tomorrow){
                $day = 'Mañana';
            }else {
                $day = $value;
            };
            $data[] = [
                'fecha' => $day,
                'cantidad' => $orders->where('dia',$value)->count(),
                'data' => $orders->where('dia',$value)->values()
            ] ;
        }
        return response()->json(['message' => 'consultado correctamente', 'data' =>$data]);

       } catch (\Exception $e) {
            return response($e);
       }
    }

    public  function getOrderBasic($idTienda,$idOrden){
        try {
            $ordenes = DB::table('yap_restaurantes.ordenes as o')
            ->select('o.id','o.estado','o.createdAt as fechaOrden','o.entregaHora')
            ->where('o.idTienda',$idTienda)
            ->where('o.id',$idOrden)
            ->get();

            $data = $ordenes->map(function($item){
                $ordenesTiendas = DB::table('yap_restaurantes.ordenesTiendas')->where('idOrden',$item->id)->get();
                $cedido = $ordenesTiendas->map(function($itemOrder)use($item){

                    $tenda = DB::table('yap_datos.tiendas')
                    ->select('nombre')
                    ->where('id',$itemOrder->idTiendaDestino)
                    ->first();
                    $user = DB::table('yap_datos.users')
                    ->select('nombre')
                    ->where('id',$itemOrder->id)
                    ->first();

                return [
                        'fecha'=>Carbon::parse($itemOrder->createdAt)->format('j F Y'),
                        'hora'=>Carbon::parse($item->fechaOrden)->format('g:i a'),
                        'usuario'=>$user->nombre,
                        'tienda'=>$tenda->nombre
                ];
                });
                return [
                    'id' => $item->id ,
                    'estado' => $item->estado,
                    'fechaOrden' => Carbon::parse($item->fechaOrden)->format('j F Y'),
                    'horaOrden' =>  Carbon::parse($item->fechaOrden)->format('g:i a'),
                    'fechaEntrega' => Carbon::parse($item->entregaHora)->format('j F Y '),
                    'horaEntrega' => Carbon::parse($item->entregaHora)->format('g:i a'),
                    'historialCedida' => $cedido
                ];
            });
            return response()->json(['message' => 'consultado correctamente', 'data' => $data],200);
        } catch (\Exception $e) {
            return response($e);
        }
    }
    public  function getOrderUser($idTienda,$idOrden){
        try {
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $month = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
            $userData = DB::table('yap_restaurantes.ordenes as o')
            ->select('o.id','o.createdBy as userId','o.entregaBarrio','o.tipoPedido','yrod.direccion as direccion','yrod.direccionObservacion','yrod.observacionEntrega','yrod.idMesa')
            ->selectRaw("(select count(*) from yap_restaurantes.ordenes as yro where yro.createdBy = userId AND yro.idPuntoNegativo > 0) as puntosNegativos ")
            //->selectRaw("(select count(*) from yap_restaurantes.ordenes as yro where yro.createdBy = userId AND yro.estado IN (21,22,23,24,25)  AND  ( yro.createdAt =< $now AND yro.createdAt >= $month)) as pedidosUltimoMes")
            ->selectRaw("(SELECT COUNT(*) FROM yap_restaurantes.ordenes AS yro WHERE yro.createdBy = userId AND yro.estado IN (21, 22, 23, 24, 25) AND yro.createdAt <= NOW() AND yro.createdAt >= DATE_SUB(NOW(), INTERVAL 1 MONTH)) AS pedidosUltimoMes")
            ->selectRaw("(SELECT COUNT(*) FROM yap_restaurantes.ordenes AS yro WHERE yro.createdBy = userId AND yro.estado IN (21, 22, 23, 24, 25) AND yro.createdAt <= NOW() AND yro.createdAt >= DATE_SUB(NOW(), INTERVAL 12 MONTH)) AS pedidosUltimoAnio")
            ->selectRaw("(SELECT COUNT(*) FROM yap_restaurantes.ordenes AS yro WHERE yro.createdBy = userId AND yro.estado IN (21, 22, 23, 24, 25) ) AS primerPedido")
            ->selectRaw("(SELECT COUNT(*) FROM yap_datos.ordenesChats AS ydoc WHERE ydoc.idOrdenRestaurante = o.id ) AS chats")
            ->selectRaw("(SELECT nombre FROM yap_datos.tiendasMesas AS ydtm WHERE ydtm.id = yrod.idMesa ) AS mesa")
            ->selectRaw("(SELECT COUNT(distinct idPuntoNegativo) FROM yap_restaurantes.ordenes AS yro WHERE yro.createdBy = userId And yro.idPuntoNegativo IS NOT  NULL  ) AS reportes")
            ->leftJoin('yap_restaurantes.ordenesDatos as yrod','yrod.idOrden','o.id')
            ->where('o.idTienda',$idTienda)
            ->where('o.id',$idOrden)
            ->first();

            $order = DB::table('yap_restaurantes.ordenes as o')
            ->where('o.createdBy',$userData->userId)
            ->get();

        $user = DB::table('yap_datos.users')->where('id',$userData->userId)->first();

        $data =  [
            'id' => $userData->id,
            'nombre' => $user->nombre,
            'puntosNegativos'=>$userData->puntosNegativos,
            'pedidosUltimoMes'=>$userData->pedidosUltimoMes,
            'pedidoUltimoAnio'=>$userData->pedidosUltimoAnio,
            'primerPedido'=>$userData->primerPedido ? true : false,
            'chat'=>$userData->chats ? true : false,
            'chatMensajes'=>$userData->chats ,
            'direccion'=>$userData->direccion ,
            'direccionObservacion'=>$userData->direccionObservacion ,
            'barrio'=>$userData->entregaBarrio ,
            'observacionEntrega'=>$userData->observacionEntrega ,
            'tipoPedido'=>$userData->tipoPedido ,
            'mesa'=>$userData->mesa,
            'reportes'=>$userData->reportes

        ];

        return response()->json(['message' => 'consultado correctamente', 'data'=>$data]);
        } catch (\Exception $e) {
            return  response($e);
        }
    }


    public function getOrderDelivery($idTienda,$idOrden){
        try {
             $userDeliveryId = DB::table('yap_restaurantes.ordenes as yro')
            ->select('*')
            ->leftJoin('yap_datos.users as ydu','ydu.id','yro.idUserDelivery')
            ->where('yro.id',$idOrden)->first();

            return [
                'idUserDelivery'=>$userDeliveryId->idUserDelivery,
            ];
        } catch (\Exception $e) {
            return response($e);
        }
    }
}
