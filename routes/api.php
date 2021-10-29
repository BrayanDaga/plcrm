<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

//Post Store User
Route::group(['prefix' => '/v1'], function(){
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
        Route::post('/register', [AuthController::class, 'store']);
    });
});

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
            Route::group(['prefix' => '/course'],function(){
                Route::group(['prefix' => '/temary'],function(){
                    Route::get('/get-all-class/{id}',[CourseController::class,'show']);
                });
            });
        });
    }
});