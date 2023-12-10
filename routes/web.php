<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

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

// * frontend
Route::get('/', [FrontendController::class, 'index']);

Route::get('/about', [FrontendController::class, 'about'])->name('about');

// * auth
Route::get('login', [LoginController::class, 'index'])
    ->name('login');

Route::post('login', [LoginController::class, 'store']);

Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');

Route::get('register', [RegistrasiController::class, 'index'])
    ->name('register');

Route::post('register', [RegistrasiController::class, 'store'])
    ->name('register');

Route::group(
    [
        'namespace' => 'App\Http\Controllers\Backend',
        'prefix' => 'control',
        'as' => 'backend.',
        'middleware' => [
            'sidebar_backend'
        ]
    ],
    function () {
        Route::get('/', function () {
            return redirect('control/dashboard');
        });

        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        // * report
        // * general
        Route::get('report-general', 'ReportController@general')->name('report_general');
        Route::get('report-general-add', 'ReportController@addGeneral')->name('report_general_add');
        Route::get('general-list', 'ReportController@generalDataTable')->name('general_list');
        Route::post('save-general', 'ReportController@saveGeneral')->name('save_general');
        Route::get('export-general', 'ReportController@exportGeneral')->name('export_general');
        Route::post('import-general', 'ReportController@importGeneral')->name('import_general');

        // * artist
        Route::get('report-artist', 'ReportArtistController@index')->name('report_artist');
        Route::get('report-artist-add', 'ReportArtistController@create')->name('report_artist_add');
        Route::get('artist-list', 'ReportArtistController@indexDataTable')->name('artist_list');
        Route::post('save-artist', 'ReportArtistController@store')->name('save_artist');

        // * channel
        Route::get('report-channel', 'ReportChannelController@index')->name('report_channel');
        Route::get('report-channel-add', 'ReportChannelController@create')->name('report_channel_add');
        Route::get('channel-list', 'ReportChannelController@indexDataTable')->name('channel_list');
        Route::post('save-channel', 'ReportChannelController@store')->name('save_channel');

        // * platform
        Route::get('report-platform', 'ReportPlatformController@index')->name('report_platform');
        Route::get('report-platform-add', 'ReportPlatformController@create')->name('report_platform_add');
        Route::get('platform-list', 'ReportPlatformController@indexDataTable')->name('platform_list');
        Route::post('save-platform', 'ReportPlatformController@store')->name('save_platform');
        Route::get('export-platform', 'ReportPlatformController@export')->name('export_platform');
        Route::post('import-platform', 'ReportPlatformController@import')->name('import_platform');


        // * withdraws
        Route::get('withdraws', 'WithdrawsController@index')->name('withdraws');
        Route::get('withdraws-list', 'WithdrawsController@indexDataTable')->name('withdraws_list');
        Route::post('withdraw-request', 'WithdrawsController@withdrawRequest')->name('withdraw_request');
        Route::post('withdraw-approve', 'WithdrawsController@approveWithdraw')->name('withdraw_approve');
        Route::get('withdraws-invoice/{id}', 'WithdrawsController@invoiceWithdraws')->name('withdraws_invoice');

        // * users
        Route::get('users', 'UsersController@index')->name('users');
        Route::get('create-user', 'UsersController@create')->name('create_user');
        Route::post('save-user', 'UsersController@storeUser')->name('save_user');
        Route::get('users-list', 'UsersController@indexDataTable')->name('users_list');
        Route::get('users-profile/{id}', 'UsersController@profileUser')->name('users_profile');

        Route::post('save-profile', 'UsersController@saveProfile')->name('save_profile');
        Route::post('save-bank-account', 'BankAccountController@saveBankAccount')->name('save_bank_account');
        Route::post('save-photo-profile', 'UsersController@storePhotoProfile')->name('save_photo_profile');

        Route::post('change-password', 'UsersController@storeChangePassword')->name('change_password');
    }
);
