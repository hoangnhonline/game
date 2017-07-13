<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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
        'client_id' => '1747775502156188',
        'client_secret' => '740c067c814a3f8799b635e03dc2f700',
        'redirect' => env('APP_URL') . '/social-auth/facebook/callback/',
    ],

    'google' => [
        'app_name' => 'Download game mobile',
        'client_id' => '752162154695-qqg3qkgdbhg5ubju6gvs180hjo532nfp.apps.googleusercontent.com',
        'client_secret' => '7-JXN9lr-65vLDjTX4qwtUtQ',
        'redirect' => env('APP_URL') . '/callback/google',
    ],

];
