<?php

use App\Http\Controllers\Accounts\CustodyAccountController;
use App\Http\Controllers\Auth\ApproveUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\UserPermissionController;
use App\Http\Controllers\Entities\CustodianController;
use App\Http\Controllers\Entities\InvestorController;
use App\Http\Controllers\Entities\PortfolioController;
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

Route::middleware(['auth', 'approved'])->group(function () {
    Route::view('/', 'index')->name('index');
    Route::view('/about', 'about')->name('about');

    Route::prefix('users')->group(function () {
        Route::controller(ApproveUserController::class)->group(function () {
            Route::get('approve', 'index')->name('users.approve');
            Route::post('approve', 'store')->name('users.approve');
        });
        Route::controller(RegisteredUserController::class)->group(function () {
            Route::get('account', 'index')->name('users.account');
            Route::delete('account', 'destroy')->name('users.destroy');
        });
        Route::controller(UserPermissionController::class)->group(function () {
            Route::get('permissions', 'index')->name('permissions.index');
            Route::put('permissions/{user}', 'store' )->name('permissions.store');
        });
    });

    Route::prefix('entities')->group(function () {
        Route::resource('custodians', CustodianController::class)
            ->except(["show", "edit"]);
        Route::resource('investors', InvestorController::class)
            ->except(["show", "edit"]);
        Route::resource('portfolios', PortfolioController::class)
            ->except(["show", "edit"]);
    });

    Route::prefix('accounts')->group(function () {
        Route::resource('custody', CustodyAccountController::class)
            ->except(["show"]);
    });
});

require __DIR__.'/auth.php';
