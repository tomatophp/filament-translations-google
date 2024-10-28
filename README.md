![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-translations-google/master/arts/3x1io-tomato-translations-google.jpg)

# Filament Google Translations

[![Dependabot Updates](https://github.com/tomatophp/filament-translations-google/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/tomatophp/filament-translations-google/actions/workflows/dependabot/dependabot-updates)
[![PHP Code Styling](https://github.com/tomatophp/filament-translations-google/actions/workflows/fix-php-code-styling.yml/badge.svg)](https://github.com/tomatophp/filament-translations-google/actions/workflows/fix-php-code-styling.yml)
[![Tests](https://github.com/tomatophp/filament-translations-google/actions/workflows/tests.yml/badge.svg)](https://github.com/tomatophp/filament-translations-google/actions/workflows/tests.yml)
[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-translations-google/version.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)
[![License](https://poser.pugx.org/tomatophp/filament-translations-google/license.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)
[![Downloads](https://poser.pugx.org/tomatophp/filament-translations-google/d/total.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)

Translations Manager extension to use Google translation crawling to auto translate your __(), trans() fn

## Screenshots


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
