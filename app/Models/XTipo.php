<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XTipo extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'xTipos';

    public static function getType($id){
        try {
           return $result = self::where('id',$id)->first();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
