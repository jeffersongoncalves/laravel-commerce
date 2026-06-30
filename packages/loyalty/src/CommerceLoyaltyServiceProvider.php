<?php

namespace JeffersonGoncalves\Commerce\Loyalty;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceLoyaltyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-loyalty';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_loyalty_accounts_table',
                'create_commerce_loyalty_transactions_table',
            ]);
    }
}
