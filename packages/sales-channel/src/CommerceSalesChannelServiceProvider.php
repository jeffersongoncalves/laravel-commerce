<?php

namespace JeffersonGoncalves\Commerce\SalesChannel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceSalesChannelServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-sales-channel';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_sales_channels_table');
    }
}
