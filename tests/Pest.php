<?php

declare(strict_types=1);

$packages = [
    'core', 'currency', 'store', 'sales-channel', 'region',
    'stock-location', 'api-key', 'user', 'auth',
    'product', 'pricing', 'inventory',
    'customer', 'tax', 'cart', 'order',
    'payment', 'fulfillment',
    'promotion', 'loyalty', 'store-credit', 'translation',
    'checkout', 'storefront', 'admin', 'suite',
];

foreach ($packages as $dir) {
    require __DIR__.'/../packages/'.$dir.'/tests/Pest.php';
}
