<?php

declare(strict_types=1);

$packages = [
    'core', 'currency', 'store', 'sales-channel', 'region', 'suite',
];

foreach ($packages as $dir) {
    require __DIR__.'/../packages/'.$dir.'/tests/Pest.php';
}
