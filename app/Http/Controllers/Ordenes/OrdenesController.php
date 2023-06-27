<?php

namespace App\Http\Controllers\Ordenes;

use stdClass;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Orden;
use App\Models\XTipo;
use App\Models\ZBanco;

use App\Models\Producto;
use App\Models\OrdenDato;
use App\Models\OrdenEstado;
use App\Models\OrdenTienda;
use Illuminate\Http\Request;
use App\Models\OrdenProducto;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OrdenProductoTopping;
use App\Models\Topping;
use App\Models\ToppingGrupo;

use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Validator;

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
        ->selectRaw("(select count(*) from yap_restaurantes.ordenesProductos as op where op.idOrden = o.id) as cantidadProductos")
        //->selectRaw("(select if(count(*)>0,1,0) from yap_datos.ordenesChats as doc where doc.idOrdenRestaurante = o.id) as tieneChat")
        ->selectRaw("1 as tieneChat")
        ->leftJoin('yap_restaurantes.ordenesDatos as od','od.idOrden','o.id')
        ->whereIn('o.estado',[11,12,13,14,15])
        ->where('o.idTienda',$id)
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

                $day =  ucfirst(Carbon::parse($value)->locale('es')->translatedFormat('l, d F '));


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
                        'fecha'=>Carbon::parse($itemOrder->createdAt)->locale('es')->translatedFormat('j M Y'),
                        'hora'=>Carbon::parse($item->fechaOrden)->format('g:i a'),
                        'usuario'=>$user->nombre,
                        'tienda'=>$tenda->nombre
                ];
                });
                return [
                    'id' => $item->id ,
                    'estado' => $item->estado,
                    'fechaOrden' => Carbon::parse($item->fechaOrden)->locale('es')->translatedFormat('j M Y'),
                    'horaOrden' =>  Carbon::parse($item->fechaOrden)->format('g:i a'),
                    'fechaEntrega' => Carbon::parse($item->entregaHora)->locale('es')->translatedFormat('j M Y '),
                    'horaEntrega' => Carbon::parse($item->entregaHora)->format('g:i a'),
                    'historialCedida' => $cedido
                ];
            })->first();
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

             $order =  Orden::getOrderCreatedBy($userData->userId);


        $user = DB::table('yap_datos.users')->where('id',$userData->userId)->first();


        $data =  [
            'id' => $userData->id,
            'nombre' => $user->nombre.' '.$user->apellido,
            'usuarioReportado' => $order->where('idPuntoNegativo','!=',null)->count(),
            'puntosNegativos'=>$userData->puntosNegativos,
            'pedidosUltimoMes'=>$userData->pedidosUltimoMes,
            'pedidoUltimoAnio'=>$userData->pedidosUltimoAnio,
            'primerPedido'=>$userData->primerPedido ? 1 : 0,
            'chat'=>$userData->chats ? 1 : 0,
            'chatMensajes'=>$userData->chats ,
            'direccion'=>$userData->direccion ,
            'direccionObservacion'=>ucfirst($userData->direccionObservacion),
            'barrio'=>ucfirst($userData->entregaBarrio),
            'observacionEntrega'=>ucfirst($userData->observacionEntrega ),
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


                $calificated = new stdClass();
                $userDelivery = Orden::getOrderUserDeliveryId($idOrden);
                if($userDelivery){
                    $calificated = collect(Orden::getOrderInfoDelivery($userDelivery->idUserDelivery))->first();
                }


            $data =  [
                'idUserDelivery'=>$userDelivery->idUserDelivery?? null,
                'nombre'=>$userDelivery->nombre?? "",
                'fotoMini'=>$userDelivery->fotoMini?? "",
                'calificacionCliente'=> $calificated->calificacionDeliveryCliente?? 0.0,
                'cantidadCliente'=>$calificated->cantidadCliente?? 0,
                'calificacionRestaurante'=>$calificated->calificacionRestaurante?? 0.0,
                'cantidadRestaurante'=>$calificated->restauranteCantidad?? 0,
                'entregaHora'=>$calificated->entregaHora?? ""
            ];

            return response()->json(['message' => 'consultado correctamente', 'data'=>$data]);

        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function postOrderDelivery(Request $request,$idTienda,$idOrden){
        $request['idTienda'] = $idTienda;
        $request['idOrden'] = $idOrden;
        $v = Validator::make($request->all(),[
            'idUserDelivery'  => 'required|int|exists:users,id',
            'idTienda'=> 'required|int',
            'idOrden'=>  'required|int|exists:mysql2.ordenes,id',
        ],[
            '*.required'=>' el campo :attribute es obliogatorio',
            '*.integer'=>' el campo :attribute debe ser un numero entero'
        ]);
        $v->after(function ($validate)use($request) {
            $user = User::where('id',$request->idUserDelivery)->first();
            if($user->tipo != 41){
                $validate->errors()->add('idUserDelivery','El usuario no es un domiciliario');
            }
        });
        if($v->fails()){
            return response()->json(['message' => $v->errors()],400);
        }
        try {
            $assingDelivery = Orden::postOrderDelivery($idTienda,$idOrden,$request->idUserDelivery);
            return   self::getOrderDelivery($idTienda,$idOrden);
        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function getDetailPay($idTienda,$idOrden){
        try {
            $orderData =  Orden::getOrderData($idOrden);
            $orderProducts =  OrdenProducto::getOrderProducts($idOrden);

            if ($orderData->formaPago !== 1) {

                $zBank = ZBanco::getOneData($orderData->idCuentaBanco?? null);
                $bankInfo = XTipo::getType($zBank->idBanco?? null);
                $user = User::getUser($orderData->idUserTransferenciaConfirmada);
                $tranfer = [
                    'banco'=>$bankInfo->nombre,
                    'imagen'=>$bankInfo->imagen ,
                    'cuentaTipo'=>$zBank->cuentaTipo,
                    'cuentaNumero'=>$zBank->cuentaNumero,
                    'tranferenciaArchivo'=>$orderData->transferenciaArchivo,
                    'tranferenciaEstado'=>$orderData->transferenciaEstado,
                    'userTranferencia'=>$user->nombre?? "",
                    'tranferenciaConfirmadaFecha'=>Carbon::parse($orderData->transferenciaConfirmadaFecha)->locale('es')->translatedFormat('d M, h:m A ')
                ];
            }


            $data = [
                'valorProductos'=>$orderData->valorProductos,
                'cantidadProductos'=>$orderProducts->sum('cantidad'),
                'valorToppings'=>$orderData->valorToppings,
                'descuentoPromo'=>$orderData->valorDescuentoOrden+$orderData->valorDescuentoProducto,
                'valorDomicilio'=>$orderData->valorDomicilio,
                'valorFinal'=>$orderData->valorFinal,
                'formaPago'=>$orderData->formaPago,
                'tranferencia'=> $tranfer ?? null

            ];
            return response()->json(['message' => 'consultado correctamente','data' => $data]);
        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function postConfirmPay(Request $request,$idTienda,$idOrden){
        try {

            $request['idTienda']= $idTienda;
            $request['idOrden']= $idOrden;

            $v = Validator::make($request->all(),[
                'confirmar'=> ['required','integer',Rule::in([2,3])],
                'idTienda'=> 'required|int|exists:mysql.tiendas,id',
                'idOrden'=>  'required|int|exists:mysql2.ordenes,id',
            ],[
                '*.required'=>' el campo :attribute es obliogatorio',
                '*.integer'=>' el campo :attribute debe ser un numero entero',
                '*.in'=>' el campo :attribute debe se 2 para confirmar o 3 para rechazar',
                '*.exists'=>'no existen registros de :attribute'
            ]);
            if($v->fails()){
                return response()->json(['message' => $v->errors()],400);
            }
            $updateOrder = OrdenDato::postConfirmPay($request);

            return self::getDetailPay($idTienda,$idOrden);
        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function getIntructions($idTienda,$idOrden){
        try {
            $result = OrdenDato::getOrderDate($idOrden)->observacionOrden;
            $data = [
                'observacionOrden' => $result
            ];
            return response()->json(['message' => 'consultado correctamente','data' => $data]);
        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function getHistoryStatus($idTienda,$idOrden){
        try {

            $dataOrderDelivered =OrdenTienda::getListOrderDelivered($idOrden)->map(function ($value){

                $userCreator = User::getUser($value->createdBy);

                return [
                    'id'=>$value['id'],
                    'estado'=>"Cedido",
                    'fecha'=>Carbon::parse($value['createdAt'])->locale('es')->translatedFormat('d M Y'),
                    'hora'=>Carbon::parse($value['createdAt'])->locale('es')->translatedFormat('h:m A'),
                    'por'=>$userCreator->nombre." ".$userCreator->apellido
                ];
            });

            $data  = OrdenEstado::getOrderStatusByOrder($idOrden)->map(function ($value){

                $userCreator = User::getUser($value->createdBy);

                return [
                    'id'=>$value['id'],
                    'estado'=>$value['estado'],
                    'fecha'=>Carbon::parse($value['createdAt'])->locale('es')->translatedFormat('d M Y'),
                    'hora'=>Carbon::parse($value['createdAt'])->locale('es')->translatedFormat('h:m A'),
                    'por'=>$userCreator->nombre." ".$userCreator->apellido
                ];
            })->concat($dataOrderDelivered);

            return response()->json(['message' => 'consultado correctamente','data' => $data]);
        } catch (\Exception $e) {
            return response($e);
        }
    }

    public function getProductsByOrderId($idTienda,$idOrden){
        try {
            $data  = OrdenProducto::getOrderProducts($idOrden)->map(function($value){
                        $product = Producto::getProduct($value->idProducto);

                        $gropuToppings = OrdenProductoTopping::getGroupToppingsInfo($value->id)->map(function ($item)use($value){

                            $idsToppings = OrdenProductoTopping::getGroupToppingsInfo($value->id)->where('idGrupoTopping',$item->idGrupoTopping)->values();
                            $toppingInfo = Topping::getToppings($idsToppings->pluck('idTopping'))->map(function ($topping)use($item) {
                                return [
                                    'id'=>$topping->id,
                                    'nombre'=>$topping->nombre,
                                    'cantidad'=>$item->cantidad,
                                    'precioToppingTotal'=>$item->precioToppingTotal
                                ];
                            });

                            return  [
                                'id'=>$item->idGrupoTopping,
                                'nombre'=>ToppingGrupo::getGroupToppingsById($item->idGrupoTopping)->nombre,
                                'toppings'=>$toppingInfo
                            ];
                        })->unique('id');

                        return [
                            'id' => $value->id,
                            'imagenMini'=>$product->imagenMini,
                            'nombre'=>$product->nombre,
                            'cantidad'=>$value->cantidad,
                            'precioTeorico'=>$value->precioTeorico,
                            'precioProducto'=>$value->precioProducto,
                            'toppingsGrupos'=>$gropuToppings
                        ];
                    });
            return response()->json(['message' => 'consultado correctamente','data' => $data]);

        } catch (\Exception $e) {
            return response($e);
        }
    }
}
