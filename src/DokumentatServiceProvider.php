<?php

namespace Keysoft\Dokumentat;

use Keysoft\Dokumentat\Commands\DokumentatCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DokumentatServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('dokumentat')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_dokumenti_table')
            ->hasCommand(DokumentatCommand::class);
    }
}
