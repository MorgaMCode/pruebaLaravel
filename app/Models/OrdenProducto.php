<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProducto extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'ordenesProductos';

    public static function getOrderProducts($idOrder){
        try {
            $orderProducts = self::where('idOrden',$idOrder)
            ->get();
            return $orderProducts;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
