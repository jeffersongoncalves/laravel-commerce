<?php

namespace JeffersonGoncalves\Commerce\Customer\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JeffersonGoncalves\Commerce\Customer\CommerceCustomerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'JeffersonGoncalves\\Commerce\\Customer\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            CommerceCustomerServiceProvider::class,
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
        $stubsPath = __DIR__.'/../database/migrations';
        $tempPath = sys_get_temp_dir().'/laravel-commerce-customer-migrations';

        if (! is_dir($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        foreach (glob($stubsPath.'/*.php.stub') as $stub) {
            $filename = basename(str_replace('.php.stub', '.php', $stub));
            $target = $tempPath.'/'.$filename;

            if (! file_exists($target)) {
                copy($stub, $target);
            }
        }

        $this->loadMigrationsFrom($tempPath);
    }
}
