<?php

use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AdvertisementsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\BinaryBranchController;
use App\Http\Controllers\GrowthBonusController;
use App\Http\Controllers\StartingBonusController;
use App\Http\Controllers\UserMembreshipController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ClassifiedController;
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
    // Main Page Route
    // Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
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
        Route::get('/register/{id_referrer_sponsor}', [UserMembreshipController::class, 'register'])->name('user-membreship-register');
        Route::get('/list', [UserMembreshipController::class, 'list'])->name('user-membreship-list');
        Route::post('/create', [UserMembreshipController::class, 'create']);
        Route::get('/get-data-user/{name}', [UserMembreshipController::class, 'getDataUser']);
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

    // User Request
    Route::group(['prefix' => 'config/user-request'], function () {
        Route::get('/', [UserRequestController::class, 'index'])->name('user-request');
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
        Route::get('/', [UserRequestController::class, 'index'])->name('user-request');
        Route::get('/get-user-by-id/{id}', [UserRequestController::class, 'getUserById']);
        Route::post('/update-request', [UserRequestController::class, 'updateRequest']);
    });

    
    Route::group(['prefix' => '/reports'], function () {
        Route::get('/growthBonus', [ClassifiedController::class,'growthBonus'])->name('report-growthBonus');
        Route::get('/startingBonus', [ClassifiedController::class,'startingBonus'])->name('report-startingBonus');;
        Route::get('/wallets', [WalletController::class,'index'])->name('report-wallets');;
    });


    Route::group(['prefix' => '/requests'], function () {
        Route::get('/pendingPayments ', [PaymentController::class,'pendingPayments'])->name('request-pendingPayments');
        Route::get('/listpendingPayments ', [PaymentController::class,'listPendingPayments']);
       
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});
/* Rutas Programada - fin */

/* Route Apps */
Route::group(['prefix' => 'app'], function () {
    Route::get('email', [AppsController::class, 'emailApp'])->name('app-email');
    Route::get('chat', [AppsController::class, 'chatApp'])->name('app-chat');
    Route::get('todo', [AppsController::class, 'todoApp'])->name('app-todo');
    Route::get('calendar', [AppsController::class, 'calendarApp'])->name('app-calendar');
    Route::get('kanban', [AppsController::class, 'kanbanApp'])->name('app-kanban');
    Route::get('invoice/list', [AppsController::class, 'invoice_list'])->name('app-invoice-list');
    Route::get('invoice/preview', [AppsController::class, 'invoice_preview'])->name('app-invoice-preview');
    Route::get('invoice/edit', [AppsController::class, 'invoice_edit'])->name('app-invoice-edit');
    Route::get('invoice/add', [AppsController::class, 'invoice_add'])->name('app-invoice-add');
    Route::get('invoice/print', [AppsController::class, 'invoice_print'])->name('app-invoice-print');
    Route::get('ecommerce/shop', [AppsController::class, 'ecommerce_shop'])->name('app-ecommerce-shop');
    Route::get('ecommerce/details', [AppsController::class, 'ecommerce_details'])->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', [AppsController::class, 'ecommerce_wishlist'])->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', [AppsController::class, 'ecommerce_checkout'])->name('app-ecommerce-checkout');
    Route::get('file-manager', [AppsController::class, 'file_manager'])->name('app-file-manager');
    Route::get('user/list', [AppsController::class, 'user_list'])->name('app-user-list');
    Route::get('user/view', [AppsController::class, 'user_view'])->name('app-user-view');
    Route::get('user/edit', [AppsController::class, 'user_edit'])->name('app-user-edit');
});
/* Route Apps */

/* Route UI */
Route::group(['prefix' => 'ui'], function () {
    Route::get('typography', [UserInterfaceController::class, 'typography'])->name('ui-typography');
    Route::get('colors', [UserInterfaceController::class, 'colors'])->name('ui-colors');
});
/* Route UI */

/* Route Icons */
Route::group(['prefix' => 'icons'], function () {
    Route::get('feather', [UserInterfaceController::class, 'icons_feather'])->name('icons-feather');
});
/* Route Icons */

/* Route Cards */
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardsController::class, 'card_basic'])->name('card-basic');
    Route::get('advance', [CardsController::class, 'card_advance'])->name('card-advance');
    Route::get('statistics', [CardsController::class, 'card_statistics'])->name('card-statistics');
    Route::get('analytics', [CardsController::class, 'card_analytics'])->name('card-analytics');
    Route::get('actions', [CardsController::class, 'card_actions'])->name('card-actions');
});
/* Route Cards */

/* Route Components */
Route::group(['prefix' => 'component'], function () {
    Route::get('alert', [ComponentsController::class, 'alert'])->name('component-alert');
    Route::get('avatar', [ComponentsController::class, 'avatar'])->name('component-avatar');
    Route::get('badges', [ComponentsController::class, 'badges'])->name('component-badges');
    Route::get('breadcrumbs', [ComponentsController::class, 'breadcrumbs'])->name('component-breadcrumbs');
    Route::get('buttons', [ComponentsController::class, 'buttons'])->name('component-buttons');
    Route::get('carousel', [ComponentsController::class, 'carousel'])->name('component-carousel');
    Route::get('collapse', [ComponentsController::class, 'collapse'])->name('component-collapse');
    Route::get('divider', [ComponentsController::class, 'divider'])->name('component-divider');
    Route::get('dropdowns', [ComponentsController::class, 'dropdowns'])->name('component-dropdowns');
    Route::get('list-group', [ComponentsController::class, 'list_group'])->name('component-list-group');
    Route::get('modals', [ComponentsController::class, 'modals'])->name('component-modals');
    Route::get('pagination', [ComponentsController::class, 'pagination'])->name('component-pagination');
    Route::get('navs', [ComponentsController::class, 'navs'])->name('component-navs');
    Route::get('tabs', [ComponentsController::class, 'tabs'])->name('component-tabs');
    Route::get('timeline', [ComponentsController::class, 'timeline'])->name('component-timeline');
    Route::get('pills', [ComponentsController::class, 'pills'])->name('component-pills');
    Route::get('tooltips', [ComponentsController::class, 'tooltips'])->name('component-tooltips');
    Route::get('popovers', [ComponentsController::class, 'popovers'])->name('component-popovers');
    Route::get('pill-badges', [ComponentsController::class, 'pill_badges'])->name('component-pill-badges');
    Route::get('progress', [ComponentsController::class, 'progress'])->name('component-progress');
    Route::get('media-objects', [ComponentsController::class, 'media_objects'])->name('component-media-objects');
    Route::get('spinner', [ComponentsController::class, 'spinner'])->name('component-spinner');
    Route::get('toast', [ComponentsController::class, 'toast'])->name('component-toast');
});
/* Route Components */

/* Route Extensions */
Route::group(['prefix' => 'ext-component'], function () {
    Route::get('sweet-alerts', [ExtensionController::class, 'sweet_alert'])->name('ext-component-sweet-alerts');
    Route::get('block-ui', [ExtensionController::class, 'block_ui'])->name('ext-component-block-ui');
    Route::get('toastr', [ExtensionController::class, 'toastr'])->name('ext-component-toastr');
    Route::get('slider', [ExtensionController::class, 'slider'])->name('ext-component-slider');
    Route::get('drag-drop', [ExtensionController::class, 'drag_drop'])->name('ext-component-drag-drop');
    Route::get('tour', [ExtensionController::class, 'tour'])->name('ext-component-tour');
    Route::get('clipboard', [ExtensionController::class, 'clipboard'])->name('ext-component-clipboard');
    Route::get('plyr', [ExtensionController::class, 'plyr'])->name('ext-component-plyr');
    Route::get('context-menu', [ExtensionController::class, 'context_menu'])->name('ext-component-context-menu');
    Route::get('swiper', [ExtensionController::class, 'swiper'])->name('ext-component-swiper');
    Route::get('tree', [ExtensionController::class, 'tree'])->name('ext-component-tree');
    Route::get('ratings', [ExtensionController::class, 'ratings'])->name('ext-component-ratings');
    Route::get('locale', [ExtensionController::class, 'locale'])->name('ext-component-locale');
});
/* Route Extensions */

/* Route Page Layouts */
Route::group(['prefix' => 'page-layouts'], function () {
    Route::get('collapsed-menu', [PageLayoutController::class, 'layout_collapsed_menu'])->name('layout-collapsed-menu');
    Route::get('boxed', [PageLayoutController::class, 'layout_boxed'])->name('layout-boxed');
    Route::get('without-menu', [PageLayoutController::class, 'layout_without_menu'])->name('layout-without-menu');
    Route::get('empty', [PageLayoutController::class, 'layout_empty'])->name('layout-empty');
    Route::get('blank', [PageLayoutController::class, 'layout_blank'])->name('layout-blank');
});
/* Route Page Layouts */

/* Route Forms */
Route::group(['prefix' => 'form'], function () {
    Route::get('input', [FormsController::class, 'input'])->name('form-input');
    Route::get('input-groups', [FormsController::class, 'input_groups'])->name('form-input-groups');
    Route::get('input-mask', [FormsController::class, 'input_mask'])->name('form-input-mask');
    Route::get('textarea', [FormsController::class, 'textarea'])->name('form-textarea');
    Route::get('checkbox', [FormsController::class, 'checkbox'])->name('form-checkbox');
    Route::get('radio', [FormsController::class, 'radio'])->name('form-radio');
    Route::get('switch', [FormsController::class, 'switch'])->name('form-switch');
    Route::get('select', [FormsController::class, 'select'])->name('form-select');
    Route::get('number-input', [FormsController::class, 'number_input'])->name('form-number-input');
    Route::get('file-uploader', [FormsController::class, 'file_uploader'])->name('form-file-uploader');
    Route::get('quill-editor', [FormsController::class, 'quill_editor'])->name('form-quill-editor');
    Route::get('date-time-picker', [FormsController::class, 'date_time_picker'])->name('form-date-time-picker');
    Route::get('layout', [FormsController::class, 'layouts'])->name('form-layout');
    Route::get('wizard', [FormsController::class, 'wizard'])->name('form-wizard');
    Route::get('validation', [FormsController::class, 'validation'])->name('form-validation');
    Route::get('repeater', [FormsController::class, 'form_repeater'])->name('form-repeater');
});
/* Route Forms */

/* Route Tables */
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'table'])->name('table');
    Route::get('datatable/basic', [TableController::class, 'datatable_basic'])->name('datatable-basic');
    Route::get('datatable/advance', [TableController::class, 'datatable_advance'])->name('datatable-advance');
    Route::get('ag-grid', [TableController::class, 'ag_grid'])->name('ag-grid');
});
/* Route Tables */

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
    Route::get('account-settings', [PagesController::class, 'account_settings'])->name('page-account-settings');
    Route::get('profile', [PagesController::class, 'profile'])->name('page-profile');
    Route::get('faq', [PagesController::class, 'faq'])->name('page-faq');
    Route::get('knowledge-base', [PagesController::class, 'knowledge_base'])->name('page-knowledge-base');
    Route::get('knowledge-base/category', [PagesController::class, 'kb_category'])->name('page-knowledge-base');
    Route::get('knowledge-base/category/question', [PagesController::class, 'kb_question'])->name('page-knowledge-base');
    Route::get('pricing', [PagesController::class, 'pricing'])->name('page-pricing');
    Route::get('blog/list', [PagesController::class, 'blog_list'])->name('page-blog-list');
    Route::get('blog/detail', [PagesController::class, 'blog_detail'])->name('page-blog-detail');
    Route::get('blog/edit', [PagesController::class, 'blog_edit'])->name('page-blog-edit');

    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});
/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
    Route::get('login-v1', [AuthenticationController::class, 'login_v1'])->name('auth-login-v1');
    Route::get('login-v2', [AuthenticationController::class, 'login_v2'])->name('auth-login-v2');
    Route::get('register-v1', [AuthenticationController::class, 'register_v1'])->name('auth-register-v1');
    Route::get('register-v2', [AuthenticationController::class, 'register_v2'])->name('auth-register-v2');
    Route::get('forgot-password-v1', [AuthenticationController::class, 'forgot_password_v1'])->name('auth-forgot-password-v1');
    Route::get('forgot-password-v2', [AuthenticationController::class, 'forgot_password_v2'])->name('auth-forgot-password-v2');
    Route::get('reset-password-v1', [AuthenticationController::class, 'reset_password_v1'])->name('auth-reset-password-v1');
    Route::get('reset-password-v2', [AuthenticationController::class, 'reset_password_v2'])->name('auth-reset-password-v2');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
});
/* Route Authentication Pages */

/* Route Charts */
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartsController::class, 'apex'])->name('chart-apex');
    Route::get('chartjs', [ChartsController::class, 'chartjs'])->name('chart-chartjs');
    Route::get('echarts', [ChartsController::class, 'echarts'])->name('chart-echarts');
});
/* Route Charts */

// map leaflet
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
