<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Ordenes\OrdenesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orden extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'ordenes';

    public static function getOrderData($idOrder){
        try {
            $orderData  =self::where('ordenes.id',$idOrder)
            ->leftJoin('ordenesDatos as od','od.idOrden','ordenes.id')
            ->first();

            return $orderData;
        } catch (\Throwable $th) {
        throw $th;
        }
    }


    public static function getOrderCreatedBy($cretedBy){
        try {
            $registros =self::where('createdBy',$cretedBy)->get();
        return $registros;
        } catch (\Throwable $th) {
        throw $th;
        }
    }

    public static function getOrderUserDeliveryId($idOrder){
        try {
            $registros =self::where('ordenes.id',$idOrder)
            ->leftJoin('yap_datos.users as ydu','ydu.id','idUserDelivery')
            ->leftJoin('yap_datos.usersDeliverys as ydud','ydud.idUser','idUserDelivery')
            ->first();
            if($registros->idUserDelivery ){
                return $registros ;
            }
            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getOrderInfoDelivery($idUserDelivery){
       try {

        $registros =self::whereIn('estado',[21,22,23,24,25])
        ->where('idUserDelivery',$idUserDelivery)
        ->leftJoin('yap_restaurantes.ordenesDatos as yrod' , 'yrod.idOrden', 'ordenes.id')
        ->get();

        $suma =  $registros->sum('calificacionDeliveryCliente');
        $total = $registros->count('calificacionDeliveryCliente');


        $countCustomer = self::whereIn('estado',[21,22,23,24,25])
        ->where('idUserDelivery',$idUserDelivery)
        ->leftJoin('yap_restaurantes.ordenesDatos as yrod', 'yrod.idOrden','ordenes.id')
        ->whereNotNull('calificacionDeliveryCliente')
        ->distinct('ordenes.createdBy')
        ->count();

        $restaurantRating = $registros->whereNotNull('calificacionDeliveryRestaurante');
        $RestaurantCount = $registros->where('calificacionDeliveryRestaurante',"!=",null)->count('idTienda');

        ;
        return[
            'calificacionDeliveryCliente' => $registros->avg('calificacionDeliveryCliente'),
            'cantidadCliente'=>intval($countCustomer),
            'calificacionRestaurante' => $restaurantRating->avg('calificacionDeliveryRestaurante'),
            'restauranteCantidad'=>$RestaurantCount,
            'entregaHora'=>  Carbon::parse($registros->first()->entregaHora?? Carbon::now())->locale('es')->translatedFormat('d M Y - g:i a')
        ];
       } catch (\Throwable $th) {
            throw $th;
       }
    }

    public static function  postOrderDelivery($idTienda,$idOrden,$idUserDelivery){
        try {
            return DB::transaction(function () use($idOrden,$idUserDelivery){

                $postDelivery = self::where('id', $idOrden)
                ->update([
                    'idUserDelivery'=>$idUserDelivery
                ]);
            },2);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
