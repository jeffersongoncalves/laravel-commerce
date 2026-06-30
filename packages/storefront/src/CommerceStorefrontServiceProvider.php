<?php

namespace JeffersonGoncalves\Commerce\Storefront;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceStorefrontServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-storefront';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasRoute('store');
    }
}
