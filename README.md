![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-translations-google/master/art/screenshot.jpg)

# Filament translations google

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-translations-google/version.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)
[![License](https://poser.pugx.org/tomatophp/filament-translations-google/license.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)
[![Downloads](https://poser.pugx.org/tomatophp/filament-translations-google/d/total.svg)](https://packagist.org/packages/tomatophp/filament-translations-google)

Translations Manager extension to use Google translation crawling to auto translate your __(), trans() fn

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

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
