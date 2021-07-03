<?php

use App\Http\Controllers\AccountTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth']], function(){
    // Api

});*/

/*Auth::routes(['verify' => true]);*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/account-type/get-data-id/{id}', [AccountTypeController::class, 'getDataBytId']);

/*Route::get('/usersMembreship/list', [UserMembreshipController::class, 'GetList'])
    ->name('GetList');*/
/*
Route::group(['middleware' => ['auth', 'api']], function(){
    Route::get('/usersMembreship', [BinaryBranchController::class, 'getListUsersMembreship'])
        ->name('getListUsersMembreship');

});*/

