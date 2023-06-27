<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'toppings';

    public static function getToppings($id){
        try {
            return self::whereIn('id',$id)->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
