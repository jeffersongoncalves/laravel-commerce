<?php

namespace JeffersonGoncalves\Commerce\Suite\Tests;

use JeffersonGoncalves\Commerce\Core\CommerceCoreServiceProvider;
use JeffersonGoncalves\Commerce\Suite\CommerceServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            CommerceCoreServiceProvider::class,
            CommerceServiceProvider::class,
        ];
    }
}
