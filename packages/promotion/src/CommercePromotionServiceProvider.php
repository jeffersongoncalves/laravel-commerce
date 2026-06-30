<?php

namespace JeffersonGoncalves\Commerce\Promotion;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommercePromotionServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-promotion';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_campaigns_table',
                'create_commerce_promotions_table',
                'create_commerce_promotion_rules_table',
                'create_commerce_application_methods_table',
            ]);
    }
}
