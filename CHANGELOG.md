# V5.0.0

- upgrade to Filament v5 and Livewire 4 (Laravel 12 and 13, PHP 8.2+), requires `tomatophp/filament-translations` ^5.0
- the translator is resolved from the container, so an app (or a public demo) can bind its own `Stichoza\GoogleTranslate\GoogleTranslate`
- keep `:placeholders` untranslated and translate the key when a line has no English text
- the Google action respects the translation policy (`create`)
- the action is registered once under Laravel Octane
- `filament-translations-google:install` runs in-process
- add tests for the job, the action, the policy and the install command

# V1.0.0

First release of the package
