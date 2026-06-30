<?php

namespace JeffersonGoncalves\Commerce\StoreCredit;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceStoreCreditServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-store-credit';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_store_credit_accounts_table',
                'create_commerce_store_credit_transactions_table',
            ]);
    }
}
