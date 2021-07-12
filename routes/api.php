<?php

use App\Http\Controllers\AccountTypeController;
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
