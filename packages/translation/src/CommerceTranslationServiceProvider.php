<?php

namespace JeffersonGoncalves\Commerce\Translation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceTranslationServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-translation';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_commerce_translations_table');
    }
}
