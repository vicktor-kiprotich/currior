<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Consumer Key
   |--------------------------------------------------------------------------
   |
   | This value is the consumer key provided for your developer application.
   | The package needs this to make requests to the Safricom APIs.
   |
   */

    'consumer_key' => env('DARAJA_CONSUMER_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Consumer Secret
    |--------------------------------------------------------------------------
    |
    | This value is the consumer secret provided for your developer application.
    | The package needs this to make requests to the Safricom APIs.
    |
    */

    'consumer_secret' => env('DARAJA_CONSUMER_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Package Mode
    |--------------------------------------------------------------------------
    |
    | This value sets the mode at which you are using the package. Acceptable
    | values are sandbox or live
    |
    */

    'mode' => 'sandbox',

    /*
    |--------------------------------------------------------------------------
    | Initiator Details
    |--------------------------------------------------------------------------
    |
    | This array takes the credentials of the short code initiating transactions
    | to the Safaricom APIs. The name is the username for the short code and
    | credential is the password.
    |
    | possible values for type: paybill, till, msisdn
    */

    'initiator' => [
        'name' => env('DARAJA_INITIATOR_NAME', ''),
        'credential' => env('DARAJA_INITIATOR_CREDENTIAL', ''),
        'short_code' => env('DARAJA_INITIATOR_SHORTCODE', ''),
        'type' => 'paybill',
    ],

    /*
    |--------------------------------------------------------------------------
    | C2B URLs
    |--------------------------------------------------------------------------
    |
    | If you will be using the C2B API you can set the URLs that will handle the
    | validation and confirmation here. This will enable you to run the
    | artisan command to automatically register them. You can use a route name or
    | specific URL since we can not use the route() helper here
    |
    */

    'c2b_url' => [
        'confirmation' => '',
        'validation' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Timeout URLs
    |--------------------------------------------------------------------------
    |
    | Here you can set the URLs that will handle the queue timeout response from
    | each of the APIs from Safaricom. You can use a route name or specific URL
    | You can use a route name or specific URL since we can not use the
    | route() helper here
    */

    'queue_timeout_url' => [
        'b2c' => '',
        'b2b' => '',
        'reversal' => '',
        'balance' => '',
        'transaction_status' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | API Result URLs
    |--------------------------------------------------------------------------
    |
    | Here you can set the URLs that will handle the results from each of the
    | APIs from Safaricom. You can use a route name or specific URL You can
    | use a route name or specific URL since we can not use the
    | route() helper here
    |
    */

    'result_url' => [
        'b2c' => '',
        'b2b' => '',
        'reversal' => '',
        'balance' => '',
        'transaction_status' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | STK Push
    |--------------------------------------------------------------------------
    |
    | Here you can set the details to be used for for STK push. The callback
    | URL can take a route name or a specific URL since we can not use
    | the route() helper here.
    |
    */

    'stk_push' => [
        'short_code' => env('DARAJA_STK_SHORTCODE', ''),
        'callback_url' => '',
        'pass_key' => env('DARAJA_STK_PASS_KEY', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | LOGS
    |--------------------------------------------------------------------------
    |
    | Here you can set your logging requirements. If enabled a new file will
    | will be created in the logs folder and will record all requests
    | and responses to the Safaricom APIs. You can use the
    | the Monolog debug levels.
    |
    */

    'logs' => [
        'enabled' => false,
        'level' => 'DEBUG',
    ],

];
