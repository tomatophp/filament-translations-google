![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-translations-google/master/arts/fadymondy-tomato-translations-google.jpg)

# Filament Google Translations

[![Dependabot Updates](https://github.com/tomatophp/filament-translations-google/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/tomatophp/filament-translations-google/actions/workflows/dependabot/dependabot-updates)
[![PHP Code Styling](https://github.com/tomatophp/filament-translations-google/actions/workflows/fix-php-code-styling.yml/badge.svg)](https://github.com/tomatophp/filament-translations-google/actions/workflows/fix-php-code-styling.yml)
[![Tests](https://github.com/tomatophp/filament-translations-google/actions/workflows/tests.yml/badge.svg)](https://github.com/tomatophp/filament-translations-google/actions/workflows/tests.yml)
[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-translations-google/version.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)
[![License](https://poser.pugx.org/tomatophp/filament-translations-google/license.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)
[![Downloads](https://poser.pugx.org/tomatophp/filament-translations-google/d/total.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)

Translations Manager extension to use Google translation crawling to auto translate your __(), trans() fn

## Version Compatibility

| Plugin | Filament | Laravel | PHP |
|--------|----------|---------|-----|
| 1.x | 3.x | 10.x / 11.x | 8.1+ |
| 4.x ([`v4` branch](https://github.com/tomatophp/filament-translations-google/tree/v4)) | 4.x | 11.x / 12.x | 8.2+ |
| 5.x | 5.x | 12.x / 13.x | 8.2+ |

## Screenshots

![Google action](https://raw.githubusercontent.com/tomatophp/filament-translations-google/master/arts/google-action.png)
![Google modal](https://raw.githubusercontent.com/tomatophp/filament-translations-google/master/arts/google-modal.png)

## Installation

before install this package you need to have [Translation Manager](https://www.github.com/tomatophp/filament-translations) installed and configured

```bash
composer require tomatophp/filament-translations-google
```
after install your package please run this command

```bash
php artisan filament-translations-google:install
```

finally register the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentTranslationsGoogle\FilamentTranslationsGooglePlugin::make())
```

## Usage

Click the Google Translate button on the translations page and pick a language. A queued job translates the English text of every translation
(or its key when there is no English text) into that language, keeping `:placeholders` as they are, and notifies you when it is done.
Run a queue worker (`php artisan queue:work`) for the job to run.

It uses [stichoza/google-translate-php](https://github.com/Stichoza/google-translate-php), which calls the public Google Translate web endpoint:
no API key is needed, but Google rate limits it and may block servers that send many requests.

The action follows the translation policy of the Translation Manager: it needs the `create` ability.

### Use your own translator

The job resolves `Stichoza\GoogleTranslate\GoogleTranslate` from the container, so you can bind your own instance, for example with proxy options,
or a fake one that never calls Google (useful for a public demo or for tests):

```php
use Stichoza\GoogleTranslate\GoogleTranslate;

$this->app->bind(GoogleTranslate::class, fn () => new GoogleTranslate(options: ['proxy' => 'tcp://localhost:8125']));
```

## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-translations-google-config"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-translations-google-lang"
```

## Testing

if you like to run `PEST` testing just use this command

```bash
composer test
```

## Code Style

if you like to fix the code style just use this command

```bash
composer format
```

## PHPStan

if you like to check the code by `PHPStan` just use this command

```bash
composer analyse
```

## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)
