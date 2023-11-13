<?php

namespace Keysoft\Dokumentat;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Keysoft\Dokumentat\Commands\DokumentatCommand;

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
            ->hasMigration('create_dokumentat_table')
            ->hasCommand(DokumentatCommand::class);
    }
}
