<?php

namespace JeffersonGoncalves\Commerce\Cart;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceCartServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-cart';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_carts_table',
                'create_commerce_cart_line_items_table',
                'create_commerce_cart_shipping_methods_table',
            ]);
    }
}
