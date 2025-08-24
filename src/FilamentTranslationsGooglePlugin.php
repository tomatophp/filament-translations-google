<?php

namespace TomatoPHP\FilamentTranslationsGoogle;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentTranslations\Facade\FilamentTranslations;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\Pages\ListTranslations;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\Pages\ManageTranslations;
use TomatoPHP\FilamentTranslationsGoogle\Filament\Actions\GoogleTranslationAction;

class FilamentTranslationsGooglePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-translations-google';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        FilamentTranslations::register(GoogleTranslationAction::make(), ManageTranslations::class);
        FilamentTranslations::register(GoogleTranslationAction::make(), ListTranslations::class);
    }

    public static function make(): self
    {
        return new FilamentTranslationsGooglePlugin;
    }
}
