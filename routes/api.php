<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\AdvertisementsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/account-type/get-data-id/{id}', [AccountTypeController::class, 'getDataBytId']);

/*Start api config messages*/
Route::get('/advertisements/{id}', [AdvertisementsController::class, 'Detail'])->name('Detail');
Route::get('/advertisements', [AdvertisementsController::class, 'List'])->name('List');
Route::post('/advertisements', [AdvertisementsController::class, 'Add'])->name('Add');
Route::put('/advertisements/{id}', [AdvertisementsController::class, 'Edit'])->name('Edit');
Route::delete('/advertisements/{id}', [AdvertisementsController::class, 'Delete'])->name('Delete');
/*End api config messages*/