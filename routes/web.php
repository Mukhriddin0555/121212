<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\branchController;
use App\Http\Controllers\FilialManagerController;
use App\Http\Controllers\resseptionController;
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

Route::get('/', function () {
    return view('welcome');
});
//---------------------------------------------------------------------------------------------------
Route::middleware(['director','auth'])->group(function(){
    //Роль директора
    Route::get('/director', function () {
        return view('director');
    })->middleware(['auth'])->name('director');  
});

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
    Route::get('/sparepartmanager/transfer/{column}/{sort}',[sparepartmanagerController::class, 'allTransfers'])->name('allTransfers');
    Route::post('/sparepartmanager/transfered',[sparepartmanagerController::class, 'transfered'])->name('transfered');

    
});
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

//---------------------------------------------------------------------------------------------------
Route::middleware(['resseption','auth'])->group(function(){
    //роль рессепшна видеть свои заказы. фильтрация + добавление заказов пост 3 та линк
    Route::get('/resseption', function () {
        return view('resseption');
    })->middleware(['auth'])->name('resseption');
    Route::get('/resseption/{column}/{sort}',[resseptionController::class, 'ressepshnOrders'])->name('ressepshnOrders');
    Route::post('/resseption/neworder',[resseptionController::class, 'newRessepshnOrders'])->name('newRessepshnOrders');

});

//---------------------------------------------------------------------------------------------------
Route::middleware(['branchmanager','auth'])->group(function(){
    //роль зав.склада доступ только зав. складу
    //трансферларга запрос
    //ожидания холатини янгилаш статусларини узгартириш зав. склад киладиган барча ишлар
    Route::get('/zavsklad', function () {
        return view('zavsklad');
    })->middleware(['auth'])->name('zavsklad');

    Route::get('/waiting/{column}/{sort}',[branchController::class, 'allWait'])->name('allWait'); // шу ни узида янги ожидания кушилади
    Route::get('/waitings/{id}/get',[branchController::class, 'oneWait'])->name('oneWait');

    Route::get('/waitings/{id}/delete',[branchController::class, 'deleteOneWait'])->name('deleteOneWait');
    Route::get('/waitings/{id}/editstatus',[branchController::class, 'statusOneWait'])->name('statusOneWait');
    Route::get('/waitings/{id}/delivered',[branchController::class, 'deliveredOneWait'])->name('deliveredOneWait');

    Route::post('/wait/new',[branchController::class, 'addNewWait'])->name('addNewWait');

    Route::get('/wait/{id}/edit',[branchController::class, 'editOneWait'])->name('editOneWait');
    Route::post('/wait/{id}/edit',[branchController::class, 'updateOneWait'])->name('updateOneWait');

    Route::get('/waitings/selected1',[branchController::class, 'selecteddelivered'])->name('selecteddelivered');
    Route::get('/waitings/selected2',[branchController::class, 'selecteddelete'])->name('selecteddelete');
    //----------------------------------------------------------------------------------------------------------
    //продажа учун роут
    Route::get('/waitorder/{column}/{sort}',[branchController::class, 'allWaitOrder'])->name('allWaitOrder');
    Route::get('/waitorders/{id}/get',[branchController::class, 'oneWaitOrder'])->name('oneWaitOrder');

    Route::get('/waitingsorder/{id}/delete',[branchController::class, 'deleteOneWaitOrder'])->name('deleteOneWaitOrder');
    Route::get('/waitingsorder/{id}/delivered',[branchController::class, 'deliveredOneWaitOrder'])->name('deliveredOneWaitOrder');
    //----------------------------------------------------------------------------------------------------------
    //Трансфер учун
    Route::get('/transfer/my/{column}/{sort}',[branchController::class, 'myTransfers'])->name('myTransfers');
    Route::get('/transfered/my/{id}/get',[branchController::class, 'oneMyTransfer'])->name('oneMyTransfer');

    Route::get('/transfer/our/{column}/{sort}',[branchController::class, 'ourTransfers'])->name('ourTransfers');
    Route::get('/transfered/our/{id}/get',[branchController::class, 'oneOurTransfer'])->name('oneOurTransfer');

    Route::post('/newtransfer',[branchController::class, 'newtransfer'])->name('newtransfer');

});

//---------------------------------------------------------------------------------------------------
//бу админ роли факат админга доступ болиши кере
Route::middleware(['admin','auth'])->group(function(){
    Route::get('/admin', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('admin');
    //фойдаланувчиларни кушиш, куриш, узгартириш ва учириш учун
    Route::get('/users/{column}/{sort}',[adminController::class, 'allUsers'])->name('allUsers');
    Route::get('/user/{id}/get',[adminController::class, 'oneUser'])->name('oneUser');    
    Route::get('/user/{id}/delete',[adminController::class, 'deleteOneUser'])->name('deleteOneUser');

    Route::get('/users/new',[adminController::class, 'newUser'])->name('newUser');
    Route::post('/users/new',[adminController::class, 'addNewUser'])->name('addNewUser');

    Route::get('/user/{id}/edit',[adminController::class, 'editOneUser'])->name('editOneUser');
    Route::post('/user/{id}/edit',[adminController::class, 'updateOneUser'])->name('updateOneUser');
//---------------------------------------------------------------------------------------------------
    //филиалларни  кушиш, куриш, узгартириш ва учириш учун//
    Route::get('/branchs/{column}/{sort}',[adminController::class, 'allBranchs'])->name('allBranchs');    
    Route::get('/branch/{id}/get',[adminController::class, 'oneBranch'])->name('oneBranch');    
    Route::get('/branch/{id}/delete',[adminController::class, 'deleteOneBranch'])->name('deleteOneBranch');

    Route::get('/branch/new',[adminController::class, 'newBranch'])->name('newBranch');    
    Route::post('/branch/new',[adminController::class, 'addNewBranch'])->name('addNewBranch');

    Route::get('/branch/{id}/edit',[adminController::class, 'editOneBranch'])->name('editOneBranch');    
    Route::post('/branch/{id}/edit',[adminController::class, 'updateOneBranch'])->name('updateOneBranch');

//---------------------------------------------------------------------------------------------------
    //рессепшн подключения к филиалу
    Route::get('/branch/new/user/delete/{id}',[adminController::class, 'deleteUserBranch'])->name('deleteUserBranch');    
    Route::post('/branch/new/user/add/{id}',[adminController::class, 'addNewUserBranch'])->name('addNewUserBranch');
    
//----------------------------------------------------------------------------------------------------
    //статуслар кушиш/учириш
    Route::get('/allstatus',[adminController::class, 'allStatus'])->name('allStatus');
    Route::get('/status/delete/{id}',[adminController::class, 'deleteStatus'])->name('deleteStatus');    
    Route::post('/status/new/',[adminController::class, 'addStatus'])->name('addStatus');
//----------------------------------------------------------------------------------------------------
    //запчасть сап кодлари импорт экпорт. и добавление по 1 шт
    Route::get('/sparepart',[adminController::class, 'sparePart'])->name('sparePart');
    Route::get('/sparepart/search',[adminController::class, 'sparePartSearch'])->name('sparePartSearch');
    Route::get('/sparepart/delete/{sap}',[adminController::class, 'deleteSparePart'])->name('deleteSparePart');    
    Route::get('/allsparepart/export',[adminController::class, 'allExport'])->name('allExport');
    Route::post('/sparepart/new',[adminController::class, 'addsparePart'])->name('addsparePart');

//----------------------------------------------------------------------------------------------------
    //жавобларни кушиш/учириш
    Route::get('/allcallback',[adminController::class, 'allCallBack'])->name('allCallBack');
    Route::get('/callback/delete/{id}',[adminController::class, 'deleteCallBack'])->name('deleteCallBack');    
    Route::post('/callback/new/',[adminController::class, 'addCallBack'])->name('addCallBack');
});

//----------------------------------------------------------------------------------------------------

Route::get('/test', function () {
    return intval(9,9);
});

require __DIR__.'/auth.php';
