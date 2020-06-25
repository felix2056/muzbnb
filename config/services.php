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
        'client_id' => '1306411512731198',
        'client_secret' => 'ea1c2d91b4565a525159de7629a05d82',
        'redirect' => 'https://muzbnb.com/login/facebook/callback',
    ],

    'google' => [
        'client_id' => "396361647752-8bls2o2bfhdb28aqplq6drtifi7p75b7.apps.googleusercontent.com",
        'client_secret' => '7vJw3k3H3wFOhYDUSVWRoPE0',
        'redirect' => 'https://muzbnb.com/login/google/callback',
    ],

    'twitter' => [
        'client_id' => 'ekBmA5hullxLE0l1DE6vOflta',
        'client_secret' => 'OlnopMCgwPLMD9ZiW0xZlRx2KSJs6PD7aa1Es92qtBawp3iIO8',
        'redirect' => 'https://muzbnb.com/login/twitter/callback',
    ],

    'linkedin' => [
        'client_id' => '771s38iukj9lfo',
        'client_secret' => 'k0xi5680mY1XEt3G',
        'redirect' => 'https://muzbnb.com/login/linkedin/callback',
    ],
    'braintree' => [
	    'model'  => App\User::class,
	    'environment' => env('BRAINTREE_ENV'),
	    'merchant_id' => env('BRAINTREE_MERCHANT_ID'),
	    'public_key' => env('BRAINTREE_PUBLIC_KEY'),
	    'private_key' => env('BRAINTREE_PRIVATE_KEY'),
    ],

];
