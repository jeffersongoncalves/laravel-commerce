<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default currency
    |--------------------------------------------------------------------------
    |
    | ISO 4217 code used when a Money value is created without an explicit
    | currency. Amounts are always stored in the currency's minor units.
    |
    */
    'default_currency' => env('COMMERCE_DEFAULT_CURRENCY', 'usd'),
];
