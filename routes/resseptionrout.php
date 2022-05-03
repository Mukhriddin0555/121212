<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\resseptionController;




//---------------------------------------------------------------------------------------------------
Route::middleware(['resseption','auth'])->group(function(){
    //роль рессепшна видеть свои заказы. фильтрация + добавление заказов пост 3 та линк
    
    Route::get('/resseption',[resseptionController::class, 'resseptionenter'])->name('resseption');
    Route::get('/orderDelete/{id}',[resseptionController::class, 'orderDelete'])->name('orderDelete');
    Route::get('/resseption/{status}/{column?}',[resseptionController::class, 'ressepshnOrders'])->name('ressepshnOrders');
    Route::post('/resseption/neworder',[resseptionController::class, 'newRessepshnOrders'])->name('newRessepshnOrders');

});