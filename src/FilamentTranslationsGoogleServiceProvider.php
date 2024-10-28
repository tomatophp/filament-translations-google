<?php

namespace TomatoPHP\FilamentTranslationsGoogle;

use Illuminate\Support\ServiceProvider;

class FilamentTranslationsGoogleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
            \TomatoPHP\FilamentTranslationsGoogle\Console\FilamentTranslationsGoogleInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-translations-google.php', 'filament-translations-google');

        //Publish Config
        $this->publishes([
            __DIR__ . '/../config/filament-translations-google.php' => config_path('filament-translations-google.php'),
        ], 'filament-translations-google-config');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-translations-google');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('lang/vendor/filament-translations-google'),
        ], 'filament-translations-google-lang');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
