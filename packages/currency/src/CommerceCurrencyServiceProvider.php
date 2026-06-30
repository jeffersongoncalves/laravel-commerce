<?php

namespace JeffersonGoncalves\Commerce\Currency;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceCurrencyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-currency';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_currencies_table');
    }
}
