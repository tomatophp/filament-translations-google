<?php

use Filament\Facades\Filament;
use TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin;
use TomatoPHP\FilamentTranslationsGoogle\FilamentTranslationsGooglePlugin;

it('registers parent plugin', function () {
    $panel = Filament::getCurrentPanel();

    $panel->plugins([
        FilamentTranslationsPlugin::make(),
    ]);

    expect($panel->getPlugin('filament-translations'))
        ->not()
        ->toThrow(Exception::class);
});

it('registers plugin', function () {
    $panel = Filament::getCurrentPanel();

    $panel->plugins([
        FilamentTranslationsGooglePlugin::make(),
    ]);

    expect($panel->getPlugin('filament-translations-google'))
        ->not()
        ->toThrow(Exception::class);
});
