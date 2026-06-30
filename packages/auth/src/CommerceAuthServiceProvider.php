<?php

namespace JeffersonGoncalves\Commerce\Auth;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceAuthServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-auth';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_auth_identities_table',
                'create_commerce_provider_identities_table',
            ]);
    }
}
