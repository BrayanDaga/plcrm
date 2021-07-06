<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\AdvertisementsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/account-type/get-data-id/{id}', [AccountTypeController::class, 'getDataBytId']);
