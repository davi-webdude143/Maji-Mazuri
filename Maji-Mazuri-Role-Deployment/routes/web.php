<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerImportController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\MeterReadingController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\MpesaCallbackController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


/*
|--------------------------------------------------------------------------
| Authenticated Application Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Customer Management
    |--------------------------------------------------------------------------
    |
    | All authenticated users can VIEW customers.
    |
    | Only Admin and Manager can:
    | - Add customers
    | - Edit customers
    | - Delete customers
    | - Import customers
    |
    */

    Route::get(
        '/customers',
        [CustomerController::class, 'index']
    )->name('customers.index');

    Route::get(
        '/customers/{customer}',
        [CustomerController::class, 'show']
    )->name('customers.show');


    /*
    |--------------------------------------------------------------------------
    | Customer Create / Edit / Delete / Import — Admin + Manager
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::get(
            '/customers/create',
            [CustomerController::class, 'create']
        )->name('customers.create');

        Route::post(
            '/customers',
            [CustomerController::class, 'store']
        )->name('customers.store');

        Route::get(
            '/customers/{customer}/edit',
            [CustomerController::class, 'edit']
        )->name('customers.edit');

        Route::put(
            '/customers/{customer}',
            [CustomerController::class, 'update']
        )->name('customers.update');

        Route::delete(
            '/customers/{customer}',
            [CustomerController::class, 'destroy']
        )->name('customers.destroy');


        /*
        |--------------------------------------------------------------------------
        | Customer Excel Import
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/customers/import',
            [CustomerImportController::class, 'create']
        )->name('customers.import.create');

        Route::post(
            '/customers/import/preview',
            [CustomerImportController::class, 'preview']
        )->name('customers.import.preview');

        Route::post(
            '/customers/import/confirm',
            [CustomerImportController::class, 'confirm']
        )->name('customers.import.confirm');
    });


    /*
    |--------------------------------------------------------------------------
    | Customer Statement
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/customers/{customer}/statement',
        [CustomerController::class, 'statement']
    )->name('customers.statement');


    /*
    |--------------------------------------------------------------------------
    | Meter Management
    |--------------------------------------------------------------------------
    */

    Route::resource('meters', MeterController::class);


    /*
    |--------------------------------------------------------------------------
    | Meter Reading Management
    |--------------------------------------------------------------------------
    */

    Route::resource('meter-readings', MeterReadingController::class);


    /*
    |--------------------------------------------------------------------------
    | Billing Management
    |--------------------------------------------------------------------------
    */

    /*
     * Outstanding Bills Browser Report
     *
     * ADMIN + MANAGER ONLY
     *
     * The admin middleware allows both roles.
     *
     * This route must remain before the bills resource routes.
     */
    Route::middleware(['admin'])->group(function () {

        Route::get(
            '/bills/outstanding',
            [BillController::class, 'outstanding']
        )->name('bills.outstanding');


        /*
         * Outstanding Bills PDF
         *
         * ADMIN + MANAGER ONLY
         */
        Route::get(
            '/bills/outstanding/pdf',
            [BillController::class, 'outstandingPdf']
        )->name('bills.outstanding.pdf');
    });


    /*
     * Standard Bill Resource Routes
     *
     * All authenticated users can work with normal billing operations.
     */
    Route::resource('bills', BillController::class);


    /*
    |--------------------------------------------------------------------------
    | Bill PDF
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/bills/{bill}/pdf',
        [BillController::class, 'pdf']
    )->name('bills.pdf');


    /*
    |--------------------------------------------------------------------------
    | Payment Management
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/bills/{bill}/payments/create',
        [PaymentController::class, 'create']
    )->name('payments.create');


    Route::post(
        '/bills/{bill}/payments',
        [PaymentController::class, 'store']
    )->name('payments.store');


    Route::post(
        '/bills/{bill}/payments/mpesa',
        [PaymentController::class, 'mpesa']
    )->name('payments.mpesa');


    Route::get(
        '/payments',
        [PaymentController::class, 'index']
    )->name('payments.index');


    Route::get(
        '/payments/{payment}',
        [PaymentController::class, 'show']
    )->name('payments.show');


    Route::delete(
        '/payments/{payment}',
        [PaymentController::class, 'destroy']
    )->name('payments.destroy');


    /*
    |--------------------------------------------------------------------------
    | Financial Reports — Admin + Manager Only
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::get(
            '/reports',
            [ReportController::class, 'index']
        )->name('reports.index');
    });


    /*
    |--------------------------------------------------------------------------
    | System Settings — Admin + Manager
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::get(
            '/settings',
            [SystemSettingController::class, 'index']
        )->name('settings.index');

        Route::put(
            '/settings',
            [SystemSettingController::class, 'update']
        )->name('settings.update');
    });


    /*
    |--------------------------------------------------------------------------
    | User Management — Admin + Manager
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::resource('users', UserController::class)
            ->except(['show']);
    });

});


/*
|--------------------------------------------------------------------------
| M-PESA Callback Routes
|--------------------------------------------------------------------------
|
| Safaricom sends M-PESA callbacks directly to these endpoints.
|
| These routes MUST remain outside the auth middleware group because
| Safaricom cannot authenticate through the application's normal login.
|
| DO NOT move these routes inside the auth middleware group.
|
|--------------------------------------------------------------------------
*/

Route::post(
    '/mpesa/callback',
    [MpesaCallbackController::class, 'callback']
)->name('mpesa.callback');


Route::post(
    '/paybill/confirmation',
    [MpesaCallbackController::class, 'confirmation']
)->name('mpesa.paybill.confirmation');


Route::post(
    '/paybill/validation',
    [MpesaCallbackController::class, 'validation']
)->name('mpesa.paybill.validation');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

