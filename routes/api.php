<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function(){
    if(config('app.is_api')){
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
            Route::post('login', [AuthController::class, 'login'])->name('auth.login');
            Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:api');
        });

        Route::middleware(['auth:api', 'checkAuth'])->group(function(){

            //Api Account Type
            Route::group(['prefix' => '/accout-type'], function(){
                Route::get('/{id}', [AccountTypeController::class, 'getDataBytId']);
            });
        });
    }
});