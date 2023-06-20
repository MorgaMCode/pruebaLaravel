<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ordenes\OrdenesController;
use App\Http\Controllers\Users\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('ordenes')->group(function(){
Route::get('{id}', [OrdenesController::class,'getList']);
    Route::get('{idTienda}/orden/{idOrden}', [OrdenesController::class,'getOrderBasic']); //detalle orden basico
    Route::get('{idTienda}/orden/{idOrden}/usuario', [OrdenesController::class,'getOrderUser']); //detalle orden basico
    Route::get('{idTienda}/orden/{idOrden}/domiciliario', [OrdenesController::class,'getOrderDelivery']); //detalle orden basico
});

Route::get('domiciliarios', [UsersController::class,'listDelivery']); //detalle orden lista domiciliario
