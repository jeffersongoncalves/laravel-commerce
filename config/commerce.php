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

    /*
    |--------------------------------------------------------------------------
    | Tables
    |--------------------------------------------------------------------------
    |
    | Table name per domain.
    |
    */
    'tables' => [
        'api_key' => 'commerce_api_keys',
        'auth' => 'commerce_auth_identities',
        'cart' => 'commerce_carts',
        'currency' => 'commerce_currencies',
        'customer' => 'commerce_customers',
        'fulfillment' => 'commerce_fulfillments',
        'inventory' => 'commerce_inventory_items',
        'loyalty' => 'commerce_loyalty_accounts',
        'order' => 'commerce_orders',
        'payment' => 'commerce_payments',
        'pricing' => 'commerce_prices',
        'product' => 'commerce_products',
        'promotion' => 'commerce_promotions',
        'region' => 'commerce_regions',
        'sales_channel' => 'commerce_sales_channels',
        'stock_location' => 'commerce_stock_locations',
        'store' => 'commerce_stores',
        'store_credit' => 'commerce_store_credit_accounts',
        'tax' => 'commerce_tax_rates',
        'translation' => 'commerce_translations',
        'user' => 'commerce_users',
    ],
];
