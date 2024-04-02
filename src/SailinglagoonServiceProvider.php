<?php

namespace Uselagoon\Sailinglagoon;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Uselagoon\Sailinglagoon\Commands\SailinglagoonCommand;

class SailinglagoonServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('sailinglagoon')
            ->hasCommand(SailinglagoonCommand::class);
    }
}
