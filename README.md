![env-providers](https://cloud.githubusercontent.com/assets/11269635/15094471/5abfd4ec-14a5-11e6-8969-63bc9bcfd6b6.jpg)

# Laravel EnvProviders

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Code Climate][ico-codeclimate]][link-codeclimate]
[![Code Quality][ico-quality]][link-quality]
[![SensioLabs Insight][ico-insight]][link-insight]

A more finetuned way of managing your service providers in Laravel. This package
allows you to only load certain service providers when your application is in
the development, local or staging environment.

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
        "sven/env-providers": "^1.0"
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

After that, you should have see the file `config/providers.php`. In the created
configuration file you can see two arrays: `load` and `development_environments`.

There are two nested arrays in the `load` array: `providers` and `aliases`. These
follow the exact same signature as the default ones in `config/app.php`. Add
ServiceProviders to the `providers` array, and register facades via the `aliases`.

You can add values to your `development_environments` to whatever you prefer. I've
assumed some sensible defaults, but feel free to change these or add to them as much
as you want.

**Note**: You can set your application's environment in either `config/app.php`
under `env` or via your `.env` file. If you want to manage your `.env` file via
artisan, you can check out [sven/flex-env](https://git.io/flex).

## Contributing
All contributions (in the form on pull requests, issues and feature-requests) are
welcomed. See the [contributors page](../../graphs/contributors) for all contributors.

## License
`sven/env-providers` is licenced under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/env-providers.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/env-providers.svg?style=flat-square
[ico-codeclimate]: https://img.shields.io/codeclimate/github/svenluijten/env-providers.svg?style=flat-square
[ico-quality]: https://img.shields.io/scrutinizer/g/svenluijten/env-providers.svg?style=flat-square
[ico-insight]: https://img.shields.io/sensiolabs/i/510c4368-2414-43ae-85e7-486590a4961a.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sven/env-providers
[link-downloads]: https://packagist.org/packages/sven/env-providers
[link-codeclimate]: https://codeclimate.com/github/svenluijten/env-providers
[link-quality]: https://scrutinizer-ci.com/g/svenluijten/env-providers/?branch=master
[link-insight]: https://insight.sensiolabs.com/projects/510c4368-2414-43ae-85e7-486590a4961a
