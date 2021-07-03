<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/account-type/get-data-id/{id}', [AccountTypeController::class, 'getDataBytId']);

/*Start api config messages*/
Route::get('/message/{id}', [MessagesController::class, 'Detail'])->name('Detail');
Route::get('/message', [MessagesController::class, 'List'])->name('List');
Route::post('/message', [MessagesController::class, 'Add'])->name('Add');
Route::put('/message/{id}', [MessagesController::class, 'Edit'])->name('Edit');
Route::delete('/message/{id}', [MessagesController::class, 'Delete'])->name('Delete');
/*End api config messages*/