<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdenDato extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'ordenesDatos';

    //obtener datos con el idOrden
    public static function getOrderDate($idOrden){
        try {
            return $result = self::where('idOrden',$idOrden)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function postConfirmPay($request){
        try {
            return DB::transaction(function () use($request){
                return $result = self::where('idOrden',$request->idOrden)->update([
                    'transferenciaEstado'=>$request->confirmar,
                    'transferenciaConfirmadaFecha'=>Carbon::now()->format('Y-m-d  H:i:s'),
                    'idUserTransferenciaConfirmada'=>5
                ]);

            },2);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

