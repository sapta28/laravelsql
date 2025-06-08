<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Tambahkan domain yang akan digunakan untuk autentikasi Sanctum.
    | Sertakan `127.0.0.1` jika kamu tidak memakai `localhost`.
    |
    */
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', '127.0.0.1,localhost')),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guard
    |--------------------------------------------------------------------------
    */
    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration (token kedaluwarsa)
    |--------------------------------------------------------------------------
    */
    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    */
    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies'   => App\Http\Middleware\EncryptCookies::class,
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    */
    'domain' => null,

];
