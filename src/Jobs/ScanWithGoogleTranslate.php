<?php

namespace TomatoPHP\FilamentTranslationsGoogle\Jobs;

use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stichoza\GoogleTranslate\GoogleTranslate;
use TomatoPHP\FilamentTranslations\Models\Translation;

class ScanWithGoogleTranslate implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Authenticatable $user,
        public string $language = 'en'
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Resolved from the container so an app (or a public demo) can bind its own translator.
        $translator = app(GoogleTranslate::class)
            ->setTarget($this->language)
            ->preserveParameters();

        Translation::query()->chunkById(200, function (Collection $translations) use ($translator) {
            foreach ($translations as $translation) {
                $source = $translation->text['en'] ?? $translation->key;

                if (blank($source)) {
                    continue;
                }

                $translation->setTranslation($this->language, $translator->translate($source) ?? $source);
                $translation->save();
            }
        });

        Notification::make()
            ->title(trans('filament-translations::translation.google_scan_notifications_done'))
            ->success()
            ->sendToDatabase($this->user);
    }
}
