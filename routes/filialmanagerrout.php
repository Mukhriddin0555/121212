<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilialManagerController;

//---------------------------------------------------------------------------------------------------
//роль для управляющего филиала
Route::middleware(['branch-upr','auth'])->group(function(){
    //роль менеджера по запчастям
    Route::get('/branchfilmanager', function () {
        return view('branchfilmanager');
    })->middleware(['auth'])->name('branchfilmanager');
    Route::get('/filial/waitorders/{column}/{sort}',[FilialManagerController::class, 'waitorders'])->name('waitorders');
    Route::get('/filial/resseptionorders/{column}/{sort}',[FilialManagerController::class, 'resseptionorders'])->name('resseptionorders');
    
    
});