<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\AccountTypeController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PropiertiesforUserController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LessonController;

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
            Route::group(['prefix'=> '/messages'],function(){
                Route::get('/with/{email}',[MessageController::class,'show']);
                Route::get('list',[MessageController::class,'list']);
            });
          
            //Api Course
            Route::group(['prefix' => '/course'], function () {
                Route::get('/temary/get-all-class/{id}', [CourseController::class, 'show']);
                Route::get('/list-course/producter/{id}', [CourseController::class, 'list']);
                Route::get('/details/{course}',[CourseController::class,'detailsCourse']);
                Route::get('/recomendations/{category}',[CourseController::class,'recomendations']);
            });

            //Api Dashboard
            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('/getattributes', [PropiertiesforUserController::class, 'getPropierties']);
                Route::get('/saleshistory', [SalesController::class, 'index'])->name('api.saleshistory.index');
                Route::get('/saleshistory/{payment}', [SalesController::class, 'show'])->name('api.saleshistory.show');
                Route::get('/lastlessonseen', LessonController::class);

            });

            //Api Cart
            Route::group(['prefix'=>'cart'],function(){
                Route::get('/show',[CartController::class,'showCart']);
                Route::get('/add/{course}',[CartController::class,'validateCart']);
                Route::get('/remove/{cartDetail}',[CartController::class,'removeCart']);
                Route::get('/clear/{cart}',[CartController::class,'clearCart']);
                Route::get('/update/{action}',[CartController::class,'updateCart']);
            });
        });
    }
});
