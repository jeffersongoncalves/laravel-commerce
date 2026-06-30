<?php

namespace JeffersonGoncalves\Commerce\Payment;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommercePaymentServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-payment';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_payment_collections_table',
                'create_commerce_payment_sessions_table',
                'create_commerce_payments_table',
                'create_commerce_captures_table',
                'create_commerce_refunds_table',
            ]);
    }
}
