<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenEstado extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'ordenesEstados';

    public static function getOrderStatusByOrder($idOrden){
        return $data = self::where('idOrden',$idOrden)->orderBy('estado','asc')->get();
    }
}
