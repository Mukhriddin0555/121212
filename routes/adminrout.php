<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

Route::middleware(['admin','auth'])->group(function(){
    Route::get('/admin', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('admin');
    //фойдаланувчиларни кушиш, куриш, узгартириш ва учириш учун
    Route::get('/users/{column?}/{sort?}',[adminController::class, 'allUsers'])->name('allUsers');
    Route::get('/user/{id}/get',[adminController::class, 'oneUser'])->name('oneUser');    
    Route::get('/user/{id}/delete',[adminController::class, 'deleteOneUser'])->name('deleteOneUser');

    Route::get('/usersadd/new',[adminController::class, 'newUser'])->name('newUser');
    Route::post('/usersadd/new',[adminController::class, 'addNewUser'])->name('addNewUser');

    Route::get('/user/{id}/edit',[adminController::class, 'editOneUser'])->name('editOneUser');
    Route::post('/user/{id}/edit',[adminController::class, 'updateOneUser'])->name('updateOneUser');
//---------------------------------------------------------------------------------------------------
    //филиалларни  кушиш, куриш, узгартириш ва учириш учун//
    Route::get('/allbranchsget/{column?}/{sort?}',[adminController::class, 'allBranchs'])->name('allBranchs');    
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
    Route::post('/sparepart/modelImport',[adminController::class, 'modelImport'])->name('modelImport');
    Route::post('/sparepart/me2nImport',[adminController::class, 'importMe2n'])->name('me2nImport');

//----------------------------------------------------------------------------------------------------
    //жавобларни кушиш/учириш
    Route::get('/allcallback',[adminController::class, 'allCallBack'])->name('allCallBack');
    Route::get('/callback/delete/{id}',[adminController::class, 'deleteCallBack'])->name('deleteCallBack');    
    Route::post('/callback/new/',[adminController::class, 'addCallBack'])->name('addCallBack');
});

//----------------------------------------------------------------------------------------------------