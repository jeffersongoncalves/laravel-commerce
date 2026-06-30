<?php

namespace JeffersonGoncalves\Commerce\Core\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JeffersonGoncalves\Commerce\Core\CommerceCoreServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'JeffersonGoncalves\\Commerce\\Core\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            CommerceCoreServiceProvider::class,
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

        $configPath = __DIR__.'/../config/commerce-core.php';
        if (file_exists($configPath)) {
            $app['config']->set('commerce-core', require $configPath);
        }
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Fixtures/migrations');
    }
}
