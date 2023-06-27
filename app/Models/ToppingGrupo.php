<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToppingGrupo extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'toppingsGrupos';

    public static function getGroupToppingsById($id){
        try {
            return  self::where('id',$id)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
