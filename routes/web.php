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
    | IMPORTANT:
    | Specific/static customer routes such as:
    |
    |   /customers/create
    |   /customers/import
    |
    | MUST appear before:
    |
    |   /customers/{customer}
    |
    | Otherwise Laravel can interpret "create" or "import" as a
    | customer route parameter and return a 404.
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Customer Create / Edit / Delete / Import
    |--------------------------------------------------------------------------
    |
    | Route-level middleware allows Admin + Manager.
    | Controller-level authorization determines which operations are
    | actually permitted.
    |
    */

    Route::middleware(['admin'])->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Create Customer
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/customers/create',
            [CustomerController::class, 'create']
        )->name('customers.create');


        /*
        |--------------------------------------------------------------------------
        | Store Customer
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/customers',
            [CustomerController::class, 'store']
        )->name('customers.store');


        /*
        |--------------------------------------------------------------------------
        | Edit Customer
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/customers/{customer}/edit',
            [CustomerController::class, 'edit']
        )->name('customers.edit');


        /*
        |--------------------------------------------------------------------------
        | Update Customer
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/customers/{customer}',
            [CustomerController::class, 'update']
        )->name('customers.update');


        /*
        |--------------------------------------------------------------------------
        | Delete / Deactivate Customer
        |--------------------------------------------------------------------------
        */

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
    | Customer List
    |--------------------------------------------------------------------------
    |
    | All authenticated users can view customers.
    |
    */

    Route::get(
        '/customers',
        [CustomerController::class, 'index']
    )->name('customers.index');


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
    | Customer Details
    |--------------------------------------------------------------------------
    |
    | This dynamic route MUST remain after /customers/create and
    | /customers/import.
    |
    */

    Route::get(
        '/customers/{customer}',
        [CustomerController::class, 'show']
    )->name('customers.show');


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
| These routes MUST remain outside the auth middleware group.
|
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

