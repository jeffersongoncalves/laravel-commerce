<?php

namespace JeffersonGoncalves\Commerce\Inventory;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceInventoryServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-inventory';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_inventory_items_table',
                'create_commerce_inventory_levels_table',
                'create_commerce_reservation_items_table',
            ]);
    }
}
