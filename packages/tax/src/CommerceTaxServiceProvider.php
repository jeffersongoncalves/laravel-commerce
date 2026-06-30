<?php

namespace JeffersonGoncalves\Commerce\Tax;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceTaxServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-tax';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_tax_regions_table',
                'create_commerce_tax_rates_table',
            ]);
    }
}
