<?php

return [

    /*
    |--------------------------------------------------------------------------
    | M-PESA Environment
    |--------------------------------------------------------------------------
    */

    'env' => env('MPESA_ENV', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | M-PESA Credentials
    |--------------------------------------------------------------------------
    */

    'consumer_key' => env('MPESA_CONSUMER_KEY'),

    'consumer_secret' => env('MPESA_CONSUMER_SECRET'),

    'shortcode' => env('MPESA_SHORTCODE'),

    'passkey' => env('MPESA_PASSKEY'),

    /*
    |--------------------------------------------------------------------------
    | STK Push Callback
    |--------------------------------------------------------------------------
    */

    'callback_url' => env('MPESA_CALLBACK_URL'),

    /*
    |--------------------------------------------------------------------------
    | C2B PayBill Callbacks
    |--------------------------------------------------------------------------
    */

    'c2b_confirmation_url' => env(
        'MPESA_C2B_CONFIRMATION_URL'
    ),

    'c2b_validation_url' => env(
        'MPESA_C2B_VALIDATION_URL'
    ),

];