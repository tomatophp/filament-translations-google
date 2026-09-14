<?php

namespace TomatoPHP\FilamentTranslationsGoogle\Filament\Actions;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use TomatoPHP\FilamentTranslations\Filament\Resources\Translations\TranslationResource;
use TomatoPHP\FilamentTranslationsGoogle\Jobs\ScanWithGoogleTranslate;

class GoogleTranslationAction
{
    public static function make(): Actions\Action
    {
        return Actions\Action::make('google')
            ->requiresConfirmation()
            ->authorize(fn (): bool => (config('filament-translations.translation_resource') ?: TranslationResource::class)::canCreate())
            ->icon('heroicon-o-language')
            ->hiddenLabel()
            ->tooltip(trans('filament-translations::translation.google_scan'))
            ->schema([
                Select::make('language')
                    ->searchable()
                    ->options(
                        collect(config('filament-translations.locals'))->mapWithKeys(function (array $item, string $key): array {
                            return [$key => $item['label']];
                        })->toArray()
                    )
                    ->label(trans('filament-translations::translation.gpt_scan_language'))
                    ->required(),
            ])
            ->action(function (array $data) {
                dispatch(
                    new ScanWithGoogleTranslate(auth()->user(), $data['language'])
                );

                Notification::make()
                    ->title(trans('filament-translations::translation.google_scan_notifications_start'))
                    ->success()
                    ->send();
            })
            ->color('warning')
            ->label(trans('filament-translations::translation.google_scan'));
    }
}
