![env-providers](https://cloud.githubusercontent.com/assets/11269635/14202863/c0b21296-f7fa-11e5-9ef1-2f684537ee24.jpg)

# Package

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Code Climate][ico-codeclimate]][link-codeclimate]
[![Code Quality][ico-quality]][link-quality]
[![SensioLabs Insight][ico-insight]][link-insight]

A more finetuned way of managing your service providers in Laravel. This package
allows you to only load certain service providers in the development or staging
stage of your project.

## Installation
Via [composer](http://getcomposer.org):

```bash
$ composer require sven/env-providers
```

Or add the package to your dependencies in `composer.json` and run
`composer update` to download the package:

```json
{
    "require": {
        "sven/env-providers": "*"
    }
}
```

Next, add the `EnvServiceProvider` to your `providers` array in `config/app.php`:

```php
// config/app.php
'providers' => [
    ...
    Sven\EnvProviders\EnvServiceProvider::class,
];
```

## Usage
You must publish this package's configuration file for it to work correctly. To
do so, run the following command:

```bash
$ php artisan vendor:publish --provider="Sven\EnvProviders\EnvServiceProvider"
```

After that, you should have a file called `providers.php` in your `config/` directory.
This file should be fairly straightforward, but I'll walk you through it here.

### Dev


## Contributing
All contributions (in the form on pull requests, issues and feature-requests) are
welcomed. See the [contributors page](../../graphs/contributors) for all contributors.

## License
`sven/env-providers` is licenced under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/env-providers.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/env-providers.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/svenluijten/env-providers.svg?style=flat-square
[ico-codeclimate]: https://img.shields.io/codeclimate/github/svenluijten/env-providers.svg?style=flat-square
[ico-quality]: https://img.shields.io/scrutinizer/g/svenluijten/env-providers.svg?style=flat-square
[ico-insight]: https://img.shields.io/sensiolabs/i/insight-id.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sven/env-providers
[link-downloads]: https://packagist.org/packages/sven/env-providers
[link-travis]: https://travis-ci.org/svenluijten/env-providers
[link-codeclimate]: https://codeclimate.com/github/svenluijten/env-providers
[link-quality]: https://scrutinizer-ci.com/g/svenluijten/env-providers/?branch=master
[link-insight]: https://insight.sensiolabs.com/projects/insight-id
