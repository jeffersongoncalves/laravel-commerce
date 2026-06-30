<?php

namespace JeffersonGoncalves\Commerce\Fulfillment;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceFulfillmentServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-fulfillment';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_fulfillment_sets_table',
                'create_commerce_service_zones_table',
                'create_commerce_shipping_options_table',
                'create_commerce_fulfillments_table',
                'create_commerce_fulfillment_items_table',
            ]);
    }
}
