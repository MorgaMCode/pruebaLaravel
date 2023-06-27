<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTienda extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'ordenesTiendas';

    //obtener registros según un id de orden
    public static function getListOrderDelivered($idOrden){
        try {
          return   $data = self::where('idOrden',$idOrden)->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
