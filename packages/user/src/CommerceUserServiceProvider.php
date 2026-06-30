<?php

namespace JeffersonGoncalves\Commerce\User;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceUserServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-user';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_users_table');
    }
}
