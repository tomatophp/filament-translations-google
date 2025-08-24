<?php

use Filament\Facades\Filament;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\Pages\ListTranslations;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\Pages\ManageTranslations;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\TranslationResource;
use TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin;
use TomatoPHP\FilamentTranslationsGoogle\FilamentTranslationsGooglePlugin;
use TomatoPHP\FilamentTranslationsGoogle\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->panel = Filament::getCurrentOrDefaultPanel();

    $this->panel->plugin(
        FilamentTranslationsPlugin::make()
            ->allowCreate()
            ->allowClearTranslations()
    );

    $this->panel->plugin(
        FilamentTranslationsGooglePlugin::make()
    );
});

it('can render translation resource', function () {
    get(TranslationResource::getUrl())->assertSuccessful();
});

it('can render translation google button', function () {
    if (config('filament-translations.modal')) {
        livewire(ManageTranslations::class)
            ->mountAction('google')
            ->assertSuccessful();
    } else {
        livewire(ListTranslations::class)
            ->mountAction('google')
            ->assertSuccessful();
    }
});
