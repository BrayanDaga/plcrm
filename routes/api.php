<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BinaryBranchController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UserMembreshipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth']], function(){
    // Api

});*/

/*Auth::routes(['verify' => true]);*/

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

Route::get('/bank/{id}', [BankController::class, 'Detail'])
    ->name('Detail');

Route::get('/bank', [BankController::class, 'List'])
    ->name('List');

Route::post('/bank', [BankController::class, 'Add'])
    ->name('Add');

Route::put('/bank/{id}', [BankController::class, 'Edit'])
    ->name('Edit');

Route::delete('/bank/{id}', [BankController::class, 'Delete'])
    ->name('Delete');
