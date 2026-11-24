<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(
    basePath: dirname(__DIR__)
)

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    |
    | Register the application's web routes, console commands,
    | and health-check endpoint.
    |
    */

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Register application middleware aliases and configure
    | CSRF exclusions for external M-PESA callbacks.
    |
    */

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Admin Middleware
        |--------------------------------------------------------------------------
        |
        | Usage in routes:
        |
        | ->middleware('admin')
        |
        */

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | M-PESA Callback CSRF Exclusions
        |--------------------------------------------------------------------------
        |
        | Safaricom sends these requests directly to the application.
        | They cannot provide Laravel's normal browser CSRF token.
        |
        | The actual routes are:
        |
        | POST /paybill/confirmation
        | POST /paybill/validation
        |
        */

        $middleware->validateCsrfTokens(except: [
            'mpesa/callback',
            'paybill/confirmation',
            'paybill/validation',
        ]);
    })

    /*
    |--------------------------------------------------------------------------
    | Exceptions
    |--------------------------------------------------------------------------
    |
    | Return JSON responses when the request is an API request
    | or explicitly expects JSON.
    |
    */

    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) =>
                $request->is('api/*') ||
                $request->expectsJson(),
        );
    })

    ->create();