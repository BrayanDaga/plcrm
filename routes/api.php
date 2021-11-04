<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PropiertiesforUser;
use Illuminate\Support\Facades\Route;

//Post Store User
Route::group(['prefix' => '/v1'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('/register', [AuthController::class, 'store']);
    });
});

Route::group(['prefix' => '/v1'], function () {
    if (config('app.is_api')) {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::post('login', [AuthController::class, 'login'])->name('auth.login');
            Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:api');
        });

        Route::middleware(['auth:api', 'checkAuth'])->group(function () {
            //Api Account Type
            Route::group(['prefix' => '/accout-type'], function () {
                Route::get('/{id}', [AccountTypeController::class, 'getDataBytId']);
            });

            //Api Message
            Route::group(['prefix' => '/messages'], function () {
                Route::get('/with/{email}', [MessageController::class, 'show']);
            });

            //Api Course
            Route::group(['prefix' => '/course'], function () {
                Route::get('/temary/get-all-class/{id}', [CoursesController::class, 'show']);
                Route::get('/list-course/producter/{id}', [CoursesController::class, 'list']);
            });

            //Api Dashboard
            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('/getattributes', [PropiertiesforUser::class, 'getPropierties']);
            });
        });
    }
});
