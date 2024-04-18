<?php

namespace Uselagoon\Sailonlagoon;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Uselagoon\Sailonlagoon\Commands\SailonlagoonCommand;

class SailonlagoonServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('sailonlagoon')
            ->hasCommand(SailonlagoonCommand::class);
    }
}
