<?php

namespace JeffersonGoncalves\Commerce\Customer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceCustomerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-customer';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_customers_table',
                'create_commerce_customer_groups_table',
                'create_commerce_customer_addresses_table',
                'create_commerce_customer_group_customer_table',
            ]);
    }
}
