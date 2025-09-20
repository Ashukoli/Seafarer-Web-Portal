<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    | We have multiple guards, but all use the same `users` provider
    | (since all records are in the `users` table).
    */
    'guards' => [
        // Default web (used for frontend if needed)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Candidate guard
        'candidate' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Admin guard (SuperAdmin, Subadmin, Executive)
        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Company guard
        'company' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    | One provider: all guards share the same `users` table and `User` model.
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    | All guards can share the same password reset table if you want.
    | Or you can create separate reset tables for candidates/companies/admins.
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
