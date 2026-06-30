<?php

namespace JeffersonGoncalves\Commerce\Product;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommerceProductServiceProvider extends PackageServiceProvider
{
    public static string $name = 'commerce-product';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasMigrations([
                'create_commerce_product_collections_table',
                'create_commerce_product_types_table',
                'create_commerce_product_tags_table',
                'create_commerce_product_categories_table',
                'create_commerce_products_table',
                'create_commerce_product_options_table',
                'create_commerce_product_option_values_table',
                'create_commerce_product_variants_table',
                'create_commerce_product_images_table',
                'create_commerce_product_category_product_table',
                'create_commerce_product_product_tag_table',
                'create_commerce_product_variant_option_value_table',
            ]);
    }
}
