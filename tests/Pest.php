<?php

declare(strict_types=1);

$packages = [
    'core', 'currency', 'suite',
];

foreach ($packages as $dir) {
    require __DIR__.'/../packages/'.$dir.'/tests/Pest.php';
}
