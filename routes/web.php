<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\telegramController;
use App\Http\Controllers\sparepartmanagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/topdf', function () {
    return view('exports.topdf');
});

Route::get('/', function () {
    return view('welcome');
});
Route::post('/how_to_model_artel_bot',[telegramController::class, 'howToModel']);

//---------------------------------------------------------------------------------------------------
/*Route::middleware(['director','auth'])->group(function(){
    //Роль директора
    Route::get('/director', function () {
        return view('director');
    })->middleware(['auth'])->name('director');  
});*/

//---------------------------------------------------------------------------------------------------
Route::middleware(['manager','auth'])->group(function(){
    //роль менеджера филиалов
    Route::get('/manager', function () {
        return view('manager');
    })->middleware(['auth'])->name('manager');    
});

//---------------------------------------------------------------------------------------------------
Route::middleware(['sparepartmanager','auth'])->group(function(){
    //роль менеджера по запчастям
    Route::get('/sparepartmanager', function () {
        return view('sparepartmanager');
    })->middleware(['auth'])->name('sparepartmanager');
    Route::get('/sparepartmanager/transfer/',[sparepartmanagerController::class, 'allTransfers'])->name('allTransfers');
    Route::get('/sparepartmanager/transfered',[sparepartmanagerController::class, 'transfered'])->name('transfered');
    Route::get('/sparepartmanager/changecode',[sparepartmanagerController::class, 'changetonewcode'])->name('changetonewcode');
    Route::get('/sparepartmanager/changed',[sparepartmanagerController::class, 'changedall'])->name('changedall');
    Route::get('/sparepartmanager/onmayway',[sparepartmanagerController::class, 'onmayway'])->name('onmayway');

    
});





//---------------------------------------------------------------------------------------------------
//бу админ роли факат админга доступ болиши кере


Route::get('/test', function () {
    return view('layouts.sss');
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен";
});

require __DIR__.'/auth.php';
require __DIR__.'/adminrout.php';
require __DIR__.'/zavskladrout.php';
require __DIR__.'/resseptionrout.php';
require __DIR__.'/filialmanagerrout.php';