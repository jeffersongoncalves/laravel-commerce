<?php

namespace JeffersonGoncalves\Commerce\Product\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JeffersonGoncalves\Commerce\CommerceServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'JeffersonGoncalves\\Commerce\\Product\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            CommerceServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function defineDatabaseMigrations(): void
    {
        $stubsPath = __DIR__.'/../../database/migrations';
        $tempPath = sys_get_temp_dir().'/laravel-commerce-product-migrations';

        if (! is_dir($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        $migrations = [
            'create_commerce_product_collections_table', 'create_commerce_product_types_table', 'create_commerce_product_tags_table',
            'create_commerce_product_categories_table', 'create_commerce_products_table', 'create_commerce_product_options_table',
            'create_commerce_product_option_values_table', 'create_commerce_product_variants_table', 'create_commerce_product_images_table',
            'create_commerce_product_category_product_table', 'create_commerce_product_product_tag_table',
            'create_commerce_product_variant_option_value_table', 'add_price_set_id_to_commerce_product_variants_table',
        ];
        $stubs = array_map(fn (string $name) => $stubsPath.'/'.$name.'.php.stub', $migrations);
        usort($stubs, function (string $a, string $b): int {
            $ga = str_starts_with(basename($a), 'create_') ? 0 : 1;
            $gb = str_starts_with(basename($b), 'create_') ? 0 : 1;

            return [$ga, basename($a)] <=> [$gb, basename($b)];
        });

        array_map('unlink', (array) glob($tempPath.'/*.php'));

        $index = 0;
        foreach ($stubs as $stub) {
            $name = basename(str_replace('.php.stub', '.php', $stub));
            copy($stub, sprintf('%s/%04d_%s', $tempPath, $index++, $name));
        }

        $this->loadMigrationsFrom($tempPath);
    }
}
