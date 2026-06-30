<?php

namespace JeffersonGoncalves\Commerce\StockLocation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceStockLocationServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-stock-location';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_stock_locations_table');
    }
}
