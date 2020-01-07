![env-providers](https://cloud.githubusercontent.com/assets/11269635/15094471/5abfd4ec-14a5-11e6-8969-63bc9bcfd6b6.jpg)

# Laravel EnvProviders

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build]][link-build]
[![StyleCI][ico-styleci]][link-styleci]

A more finetuned way of managing your service providers in Laravel. This package
allows you to configure the environment certain service providers and
aliases are loaded in.

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
        "sven/env-providers": "^3.1"
    }
}
```

Next, add the `ServiceProvider` to your `providers` array in `config/app.php`:

```php
// config/app.php
'providers' => [
    ...
    Sven\EnvProviders\ServiceProvider::class,
];
```

## Usage
You must publish this package's configuration file for it to work properly. To
do so, run the following command:

```bash
$ php artisan vendor:publish --provider="Sven\EnvProviders\ServiceProvider"
```

After that, you should see the file `config/providers.php`. In the created
configuration file you can see 2 pre-defined provider groups that will help you
set up what providers and aliases should be loaded when the application is in any
of the given environments.

### Environments
In the `environments` array you can define what environments the provider group
should respond to. You may use an asterisk (`*`) to make that group's providers
and aliases load regardless of the application's environment.

**Note**: You can set your application's environment in either `config/app.php`
under `env` or via your `.env` file. If you want to manage your `.env` file via
`php artisan`, you can check out [sven/flex-env](https://git.io/flex).

### Providers
The `providers` array is where you can put the providers you want to have loaded
in the defined environments. This should be pretty straight forward as it is similar
to how you would register service providers in `config/app.php`.

### Aliases
In the `aliases` array you may define all your aliases (facades). As with the providers,
this is the same as how you would register aliases in the default `config/app.php`
configuration file.

### Example

```php
[
    'environments' => ['local', 'development', 'dev'],
    'providers' => [
        Sven\ArtisanView\ArtisanViewServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
    ],
    'aliases' => [
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
    ],
],
```

Notice how we're only loading the Debugbar ServiceProvider and facade when our
application's environment is either `local`, `development`, or `dev`. This means
you can't use the `Debugbar` facade in your project when the environment doesn't
match any of those.

## Contributing
All contributions (pull requests, issues and feature requests) are
welcome. Make sure to read through the [CONTRIBUTING.md](CONTRIBUTING.md) first,
though. See the [contributors page](../../graphs/contributors) for all contributors.

## License
`sven/env-providers` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/env-providers.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/env-providers.svg?style=flat-square
[ico-build]: https://github.com/svenluijten/env-providers/workflows/Tests%20(PHP)/badge.svg
[ico-styleci]: https://styleci.io/repos/58277758/shield

[link-packagist]: https://packagist.org/packages/sven/env-providers
[link-downloads]: https://packagist.org/packages/sven/env-providers
[link-build]: https://github.com/svenluijten/env-providers/actions?query=workflow%3ATests%20(PHP)
[link-styleci]: https://styleci.io/repos/58277758
