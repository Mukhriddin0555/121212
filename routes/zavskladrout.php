<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\branchController;



//---------------------------------------------------------------------------------------------------
Route::middleware(['branchmanager','auth'])->group(function(){
    //роль зав.склада доступ только зав. складу
    //трансферларга запрос
    //ожидания холатини янгилаш статусларини узгартириш зав. склад киладиган барча ишлар
    Route::get('/zavsklad',[branchController::class, 'zavsklad'])->name('zavsklad');
    
    Route::get('/search/get',[branchController::class, 'searchid'])->name('searchid');
    Route::get('/waitings/all/export',[branchController::class, 'allWaitExport'])->name('allWaitExport');
    Route::get('/vputi/all/{column?}',[branchController::class, 'vputi'])->name('vputi');
    Route::get('/dostavlen/all/{column?}',[branchController::class, 'dostavlen'])->name('dostavlen');
    Route::get('/waiting/all/{column?}',[branchController::class, 'allWait'])->name('allWait'); // шу ни узида янги ожидания кушилади
    Route::get('/waitings/{id}/get',[branchController::class, 'oneWait'])->name('oneWait');

    Route::get('/waitings/{id}/delete/{routename}',[branchController::class, 'deleteOneWait'])->name('deleteOneWait');
    Route::get('/waitings/{id}/delivered/{routename}',[branchController::class, 'deliveredOneWait'])->name('deliveredOneWait');

    Route::post('/wait/new',[branchController::class, 'addNewWait'])->name('addNewWait');

    Route::get('/wait/{id}/edit',[branchController::class, 'editOneWait'])->name('editOneWait');
    Route::post('/wait/{id}/edit',[branchController::class, 'updateOneWait'])->name('updateOneWait');

    Route::get('/waitings/selected1/{routename}',[branchController::class, 'selecteddelivered'])->name('selecteddelivered');
    Route::get('/waitings/selected2/{routename}',[branchController::class, 'selecteddelete'])->name('selecteddelete');
    //----------------------------------------------------------------------------------------------------------
    //продажа учун роут
    Route::get('/waitorder/{status}/{column?}',[branchController::class, 'allWaitOrder'])->name('allWaitOrder');
    Route::get('/waitorders/{id}/get',[branchController::class, 'oneWaitOrder'])->name('oneWaitOrder');

    Route::get('/waitingsorder/{id}/delete',[branchController::class, 'deleteOneWaitOrder'])->name('deleteOneWaitOrder');
    Route::get('/waitingsorder/{id}/delivered',[branchController::class, 'deliveredOneWaitOrder'])->name('deliveredOneWaitOrder');
    //----------------------------------------------------------------------------------------------------------
    //Трансфер учун
    Route::get('/transfer/my/{column?}',[branchController::class, 'myTransfers'])->name('myTransfers');
    Route::get('/transfered/my/{id}/delive',[branchController::class, 'oneMyTransfer'])->name('oneMyTransfer');
    Route::get('/transfered/my/{id}/delete',[branchController::class, 'oneMyTransferDelete'])->name('oneMyTransferDelete');
    
    Route::get('/transferoursed/{id?}',[branchController::class, 'downloadPdftransfer'])->name('downloadPdftransfer');
    Route::get('/transfer/our/{column?}',[branchController::class, 'ourTransfers'])->name('ourTransfers');
    Route::post('/transfered/our/{id}/get',[branchController::class, 'oneOurTransfer'])->name('oneOurTransfer');

    Route::post('/newtransfer',[branchController::class, 'newtransfer'])->name('newtransfer');
    //----------------------------------------------------------------------------------------------------------
    //маил учун
    Route::get('/branchmanager/mail/incoming/{column?}',[branchController::class, 'allmailincoming'])->name('FilialBranchMailAllIncoming');
    Route::get('/branchmanager/mail/outgoing/{column?}',[branchController::class, 'allmailoutgoing'])->name('FilialBranchMailAllOutgoing');
    Route::get('/branchmanager/mail/read/user1/{id}',[branchController::class, 'onemailuser1'])->name('FilialBranchMailRead1');
    Route::get('/branchmanager/mail/read/user2/{id}',[branchController::class, 'onemailuser2'])->name('FilialBranchMailRead2');
    Route::get('/branchmanager/mail/user1/delete/{id}',[branchController::class, 'deletemailuser1'])->name('FilialBranchMailDeleteUser1');
    Route::get('/branchmanager/mail/user2/delete/{id}',[branchController::class, 'deletemailuser2'])->name('FilialBranchMailDeleteUser2');
    Route::get('/branchmanager/mail/new/message',[branchController::class, 'newmail'])->name('FilialBranchMailNewMessage');
    Route::post('/branchmanager/mail/new/message',[branchController::class, 'addnewmail'])->name('FilialBranchAddMailNewMessage');
    Route::get('/branchmanager/mail/user1/deletemulti',[branchController::class, 'deletemailmultiuser1'])->name('FilialBranchMailDeleteMultiUser1');
    Route::get('/branchmanager/mail/user2/deletemulti',[branchController::class, 'deletemailmultiuser2'])->name('FilialBranchMailDeleteMultiUser2');
    

});