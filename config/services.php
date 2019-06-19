<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => env('FB_APP','819282555082278'),         // Your facebook Client ID
        'client_secret' => env('FB_APP','5de5bb05a1096d987a19227d78b1fc9b'), // Your facebook Client Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID','687169892966-uje8g1gfpos09h4la0dtmr4hdvg8eb31.apps.googleusercontent.com'),  // Your google Client ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET','6Bc5K7bVjNtcYgEzCHCVxc0t'), // Your google Client Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],
    

];
