<?php

namespace JeffersonGoncalves\Commerce\ApiKey;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceApiKeyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-api-key';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_api_keys_table');
    }
}
