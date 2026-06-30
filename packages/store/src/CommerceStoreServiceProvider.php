<?php

namespace JeffersonGoncalves\Commerce\Store;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceStoreServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-store';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_stores_table');
    }
}
