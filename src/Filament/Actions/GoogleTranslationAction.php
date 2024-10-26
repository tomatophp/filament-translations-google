<?php

namespace TomatoPHP\FilamentTranslationsGoogle\Filament\Actions;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use TomatoPHP\FilamentTranslationsGoogle\Jobs\ScanWithGoogleTranslate;

class GoogleTranslationAction
{
    public static function make(): Actions\Action
    {
        return Actions\Action::make('google')
            ->requiresConfirmation()
            ->icon('heroicon-o-language')
            ->hiddenLabel()
            ->tooltip(trans('filament-translations::translation.google_scan'))
            ->form([
                Select::make('language')
                    ->searchable()
                    ->options(
                        collect(config('filament-translations.locals'))->mapWithKeys(function ($item, $key) {
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
