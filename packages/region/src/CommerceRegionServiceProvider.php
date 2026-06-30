<?php

namespace JeffersonGoncalves\Commerce\Region;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceRegionServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-region';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_regions_table',
                'create_commerce_countries_table',
            ]);
    }
}
