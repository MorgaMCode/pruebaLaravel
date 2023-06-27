<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProductoTopping extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'ordenesProductosToppings';

    public static function getGroupToppingsInfo($idOrderProduct){
        try {
            return   $data =  self::where('idOrdenProducto', $idOrderProduct)->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
