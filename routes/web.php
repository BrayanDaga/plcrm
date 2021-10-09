<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AdvertisementsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\BinaryBranchController;
use App\Http\Controllers\BinaryCutController;
use App\Http\Controllers\GrowthBonusController;
use App\Http\Controllers\StartingBonusController;
use App\Http\Controllers\UserMembreshipController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ClassifiedController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\RamaBinariaController;
use Illuminate\Support\Facades\Auth;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify' => true]);
Route::post('login', [LoginController::class, 'login'])->name('login');

/* Rutas Programada - inicio */
/**
 * Todas las rutas establecidas deben de estar dentro de "Middleware Auth"
 */
Route::group(['middleware' => ['auth']], function () {
    Route::get('viewTree', [RamaBinariaController::class, 'viewTree']);
    Route::view('uninivel', 'uninivel')->name('uninivel');
    Route::get('listbinary', [RamaBinariaController::class, 'listbinary']);

    Route::get('mypointslog',[PointController::class,'getPointsForUser'])->name('mypointslog');
    // Main Page Route
    // Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
    Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');


    /* Route Dashboards */
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
        Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
    });
    /* Route Dashboards */

    Route::group(['prefix' => 'system'], function () {
        Route::get('binary-branch', [BinaryBranchController::class, 'binary_branch'])->name('binary-branch');
    });

    Route::group(['prefix' => 'payment'], function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payment');
        Route::get('/list', [PaymentController::class, 'List'])->name('List');
    });

    Route::group(['prefix' => 'user-membreship'], function () {
        Route::get('/register', [UserMembreshipController::class, 'register'])->name('user-membreship-register');
        Route::get('/list', [UserMembreshipController::class, 'list'])->name('user-membreship-list');
        Route::post('/create', [UserMembreshipController::class, 'create'])->name('user-membreship-create');
        Route::get('/sha/{purchase_operation_number}/{purchase_amount}', [UserMembreshipController::class, 'credentials']);
        Route::get('/get-data-user/{name}', [UserMembreshipController::class, 'getDataUser']);
        Route::get('/get-data-currentuser', [UserMembreshipController::class, 'getDataCurrentUser']);
        Route::post('/change-position-currentuser', [UserMembreshipController::class, 'changePositionCurrentUser']);
        /*Start api user-membreship*/
        Route::get('/api', [BinaryBranchController::class, 'getListUsersMembreship'])
            ->name('getListUsersMembreship');
        Route::get('/api/list', [UserMembreshipController::class, 'GetList'])
            ->name('GetList');
        /*End api user-membreship*/
    });

    //account types Routes
    Route::group(['prefix' => '/account-type'], function () {
        //view
        Route::get('/', [AccountTypeController::class, 'retornarVista'])->name('account-type');
        //api
        Route::apiResource('accountType', AccountTypeController::class);
    });

    //account types Routes
    Route::group(['prefix' => '/starting-bonus'], function () {
        //view
        Route::get('/', [StartingBonusController::class, 'retornarVista'])->name('starting-bonus');
        //api
        Route::apiResource('startingBonus', StartingBonusController::class)->except(['update']);
    });

    //account types Routes
    Route::group(['prefix' => '/growth-bonus'], function () {
        //view
        Route::get('/', [GrowthBonusController::class, 'retornarVista'])->name('growth-bonus');
        //api
        Route::apiResource('growthBonus', GrowthBonusController::class)->except(['update']);
    });


    Route::group(['prefix' => 'config/bank'], function () {
        Route::get('/', [BankController::class, 'index'])->name('bank');
        /*Start api config bank*/
        Route::get('/detail/{id}', [BankController::class, 'Detail'])->name('Detail');
        Route::get('/list', [BankController::class, 'List'])->name('List');
        Route::post('/add', [BankController::class, 'Add'])->name('Add');
        Route::put('/edit/{id}', [BankController::class, 'Edit'])->name('Edit');
        Route::delete('/delete/{id}', [BankController::class, 'Delete'])->name('Delete');
        /*End api config bank*/
    });

    Route::group(['prefix' => 'config/advertisements'], function () {
        Route::get('/', [AdvertisementsController::class, 'index'])->name('advertisements');
        /*Start api config messages*/
        Route::get('/detail/{id}', [AdvertisementsController::class, 'Detail'])->name('Detail');
        Route::get('/list', [AdvertisementsController::class, 'List'])->name('List');
        Route::post('/add', [AdvertisementsController::class, 'Add'])->name('Add');
        Route::put('/edit/{id}', [AdvertisementsController::class, 'Edit'])->name('Edit');
        Route::delete('/delete/{id}', [AdvertisementsController::class, 'Delete'])->name('Delete');
        /*End api config messages*/
    });

    Route::group(['prefix' => 'config/payment-method'], function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('payment-method');
        /*Start api config payment-method*/
        Route::get('/detail/{id}', [PaymentMethodController::class, 'Detail'])->name('Detail');
        Route::get('/list', [PaymentMethodController::class, 'List'])->name('List');
        Route::post('/add', [PaymentMethodController::class, 'Add'])->name('Add');
        Route::put('/edit/{id}', [PaymentMethodController::class, 'Edit'])->name('Edit');
        Route::delete('/delete/{id}', [PaymentMethodController::class, 'Delete'])->name('Delete');
        /*End api config payment-method*/
    });

    // User Request    
    Route::group(['prefix' => 'config/user-request'], function () {
        Route::view('/', 'content.config.user_request')->name('user-request');
        Route::get('/list', [UserRequestController::class, 'index']);
        Route::get('/get-user-by-id/{id}', [UserRequestController::class, 'getUserById']);
        Route::post('/update-request', [UserRequestController::class, 'updateRequest']);
    });


    Route::group(['prefix' => '/reports'], function () {
        Route::get('/growthBonus', [ClassifiedController::class, 'growthBonus'])->name('report-growthBonus');
        Route::get('/startingBonus', [ClassifiedController::class, 'startingBonus'])->name('report-startingBonus');;
        Route::get('/wallets', [WalletController::class, 'index'])->name('report-wallets');;
    });


    Route::group(['prefix' => '/requests'], function () {
        //     /*Pending Paymentes */
        //     // Route::get('/pendingPayments ', [PaymentController::class,'pendingPayments'])->name('request-pendingPayments');
        //     // Route::get('/listpendingPayments ', [PaymentController::class,'listUserPendingPayments']);
        Route::get('/listUserPayments ', [PaymentController::class, 'listUserPayments']);
        Route::get('/listMyPayments ', [PaymentController::class, 'listMyPayments'])->name('request-listMyPayments');
        //     // Route::match(['put', 'patch'], '/authorizePayment/{payment}', [PaymentController::class,'authorizePayment']);
        //     // Route::match(['put', 'patch'],'denypayment/{payment}', [PaymentController::class,'denyPayment']);
        //     // /***/
        // //Ruta Billetera - Fondos de Usuario
        Route::group(['prefix' => '/wallet'], function () {
            Route::get('/', [WalletController::class, 'retornarVista'])->name('wallet');
            Route::apiResource('wallets', WalletController::class)->only('index');
        });
    });

    Route::resource('/binarycut', BinaryCutController::class)->only(['index','store']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
/* Rutas Programada - fin */

Route::group(['prefix' => 'page'], function () {
    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});

/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

// map leaflet
// Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Route::view('/virtualclassroom', 'newPage')->name('virtualclass');