<?php

namespace TomatoPHP\FilamentTranslationsGoogle;

use Filament\Contracts\Plugin;
use Filament\Panel;
use TomatoPHP\FilamentTranslations\Filament\Resources\TranslationResource\Actions\ManagePageActions;
use TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin;
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
        ManagePageActions::register(GoogleTranslationAction::make());
    }

    public static function make(): self
    {
        return new FilamentTranslationsGooglePlugin;
    }
}
