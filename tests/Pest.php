<?php

declare(strict_types=1);

use JeffersonGoncalves\Commerce\Tests\TestCase;

uses(TestCase::class)->in(__DIR__.'/Feature');

$domains = [
    'Core', 'Currency', 'Store', 'SalesChannel', 'Region',
    'StockLocation', 'ApiKey', 'User', 'Auth',
    'Product', 'Pricing', 'Inventory',
    'Customer', 'Tax', 'Cart', 'Order',
    'Payment', 'Fulfillment',
    'Promotion', 'Loyalty', 'StoreCredit', 'Translation',
    'Checkout', 'Storefront', 'Admin',
];

foreach ($domains as $dir) {
    require __DIR__.'/'.$dir.'/Pest.php';
}
