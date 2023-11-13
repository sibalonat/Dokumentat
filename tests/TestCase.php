<?php

namespace Keysoft\Dokumentat\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Keysoft\Dokumentat\DokumentatServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Keysoft\\Dokumentat\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DokumentatServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');


        $migration = include __DIR__.'/../database/migrations/create_dokumenti_table.php.stub';
        $migration->up();
    }
}
