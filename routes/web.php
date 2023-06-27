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

Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'control', 'as' => 'backend.', 'middleware' => ['sidebar_backend']], function () {
    Route::get('/', function () {
        return redirect('control/dashboard');
    });

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // * report
    Route::get('report-general', 'ReportController@general')->name('report_general');
    Route::get('report-general-add', 'ReportController@addGeneral')->name('report_general_add');

    Route::get('general-list', 'ReportController@generalDataTable')->name('general_list');
    Route::post('save-general', 'ReportController@saveGeneral')->name('save_general');
    Route::get('export-general', 'ReportController@exportGeneral')->name('export_general');
    Route::post('import-general', 'ReportController@importGeneral')->name('import_general');

    // * withdraws
    Route::get('withdraws', 'WithdrawsController@index')->name('withdraws');
    Route::get('withdraws-list', 'WithdrawsController@indexDataTable')->name('withdraws_list');
    Route::post('withdraw-request', 'WithdrawsController@withdrawRequest')->name('withdraw_request');
    Route::post('withdraw-approve', 'WithdrawsController@approveWithdraw')->name('withdraw_approve');
    Route::get('withdraws-invoice/{id}', 'WithdrawsController@invoiceWithdraws')->name('withdraws_invoice');

    // * users
    Route::get('users', 'UsersController@index')->name('users');
    Route::get('users-list', 'UsersController@indexDataTable')->name('users_list');
    Route::get('users-profile/{id}', 'UsersController@storeProfileUser')->name('users_profile');

    Route::post('save-profile', 'UsersController@saveProfile')->name('save_profile');
    Route::post('save-bank-account', 'BankAccountController@saveBankAccount')->name('save_bank_account');
});
