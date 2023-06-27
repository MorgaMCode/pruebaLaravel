<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'productos';
    const CREATE_AT = 'createdAt';

    public static function  getProduct($id){
        try {
            return self::where('id',$id)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
