<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Allow only administrators and managers
     * to access protected administrative routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | Authentication Check
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {
            abort(403, 'Unauthorized access.');
        }

        /*
        |--------------------------------------------------------------------------
        | Role Check
        |--------------------------------------------------------------------------
        |
        | Admin and Manager are allowed to access
        | routes protected by the "admin" middleware.
        |
        */

        if (!in_array(auth()->user()->role, ['admin', 'manager'], true)) {
            abort(403, 'Administrator or Manager access required.');
        }

        return $next($request);
    }
}