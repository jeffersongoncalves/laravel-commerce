<?php

namespace JeffersonGoncalves\Commerce\Core;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceCoreServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-core';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
