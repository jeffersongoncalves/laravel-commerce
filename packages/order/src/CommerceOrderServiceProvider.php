<?php

namespace JeffersonGoncalves\Commerce\Order;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceOrderServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-order';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_orders_table',
                'create_commerce_order_line_items_table',
                'add_cart_id_to_commerce_orders_table',
                'create_commerce_order_transactions_table',
                'create_commerce_returns_table',
                'create_commerce_return_items_table',
                'create_commerce_exchanges_table',
                'create_commerce_exchange_items_table',
                'create_commerce_claims_table',
                'create_commerce_claim_items_table',
            ]);
    }
}
