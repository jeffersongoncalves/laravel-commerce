<?php

namespace JeffersonGoncalves\Commerce\Suite;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-commerce');
    }
}
