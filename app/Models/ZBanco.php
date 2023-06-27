<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZBanco extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'zBancos';

    public static function getOneData($id){
        try {
            return  self::where('id',$id)->first();
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
