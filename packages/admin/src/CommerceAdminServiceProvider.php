<?php

namespace JeffersonGoncalves\Commerce\Admin;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceAdminServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-admin';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasRoute('admin');
    }
}
