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
    Route::prefix('{idTienda}/orden/{idOrden}')->group(function(){
        Route::get('/',[OrdenesController::class,'getOrderBasic']); //detalle orden basico
        Route::get('usuario', [OrdenesController::class,'getOrderUser']); //detalle de usuario orden
        Route::get('domiciliario', [OrdenesController::class,'getOrderDelivery']); //mostrando datos de domiciliario de orden
        Route::get('detalle-cobro', [OrdenesController::class,'getDetailPay']); //obteniendo detalle de cobro de una orden
        Route::get('instrucciones', [OrdenesController::class,'getIntructions']); //obteniendo instrucciones de un pedido
        Route::get('productos', [OrdenesController::class,'getProductsByOrderId']); //obteniendo productos por el id de la orden
        Route::get('historial-estado', [OrdenesController::class,'getHistoryStatus']); //obteniendo historial de estados de una orden
        Route::post('detalle-cobro', [OrdenesController::class,'postConfirmPay']); //confirmando o rechazando cobro
        Route::post('domiciliario', [OrdenesController::class,'postOrderDelivery']); //asignando un domiciliario a la orden
    });
});

Route::get('domiciliarios', [UsersController::class,'listDelivery']); //detalle orden lista domiciliario
