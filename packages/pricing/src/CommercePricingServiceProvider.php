<?php

namespace JeffersonGoncalves\Commerce\Pricing;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommercePricingServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-pricing';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_price_sets_table',
                'create_commerce_price_lists_table',
                'create_commerce_prices_table',
                'create_commerce_price_rules_table',
            ]);
    }
}
