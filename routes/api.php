<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserRequestController;

use App\Http\Controllers\AdvertisementsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::get('/usersMembreship/list', [UserMembreshipController::class, 'GetList'])
    ->name('GetList');*/
/*
Route::group(['middleware' => ['auth', 'api']], function(){
    Route::get('/usersMembreship', [BinaryBranchController::class, 'getListUsersMembreship'])
        ->name('getListUsersMembreship');
});*/

Route::get('/account-type/get-data-id/{id}', [AccountTypeController::class, 'getDataBytId']);


/*Start api config messages*/
Route::get('/message/{id}', [MessagesController::class, 'Detail'])->name('Detail');
Route::get('/message', [MessagesController::class, 'List'])->name('List');
Route::post('/message', [MessagesController::class, 'Add'])->name('Add');
Route::put('/message/{id}', [MessagesController::class, 'Edit'])->name('Edit');
Route::delete('/message/{id}', [MessagesController::class, 'Delete'])->name('Delete');
/*End api config messages*/
