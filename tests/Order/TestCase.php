<?php

namespace JeffersonGoncalves\Commerce\Order\Tests;

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
            fn (string $modelName) => 'JeffersonGoncalves\\Commerce\\Order\\Database\\Factories\\'.class_basename($modelName).'Factory'
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
        $tempPath = sys_get_temp_dir().'/laravel-commerce-order-migrations';

        if (! is_dir($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        $migrations = [
            'create_commerce_orders_table', 'create_commerce_order_line_items_table', 'add_cart_id_to_commerce_orders_table',
            'create_commerce_order_transactions_table', 'create_commerce_returns_table', 'create_commerce_return_items_table',
            'create_commerce_exchanges_table', 'create_commerce_exchange_items_table', 'create_commerce_claims_table', 'create_commerce_claim_items_table',
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
