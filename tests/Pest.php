<?php

declare(strict_types=1);

$packages = [
    'core', 'suite',
];

foreach ($packages as $dir) {
    require __DIR__.'/../packages/'.$dir.'/tests/Pest.php';
}
