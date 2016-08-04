![env-providers](https://cloud.githubusercontent.com/assets/11269635/15094471/5abfd4ec-14a5-11e6-8969-63bc9bcfd6b6.jpg)

# Laravel EnvProviders

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Code Climate][ico-codeclimate]][link-codeclimate]
[![Code Quality][ico-quality]][link-quality]
[![SensioLabs Insight][ico-insight]][link-insight]
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
        "sven/env-providers": "^3.0"
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

After that, you should see the file `config/providers.php`. In the created
configuration file you can see 2 pre-defined provider groups that will help you
set up what providers and aliases should be loaded when the application is in a
certain environment.

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


## Contributing
All contributions (in the form on pull requests, issues and feature-requests) are
welcome. See the [contributors page](../../graphs/contributors) for all contributors.

## License
`sven/env-providers` is licenced under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/env-providers.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/env-providers.svg?style=flat-square
[ico-codeclimate]: https://img.shields.io/codeclimate/github/svenluijten/env-providers.svg?style=flat-square
[ico-quality]: https://img.shields.io/scrutinizer/g/svenluijten/env-providers.svg?style=flat-square
[ico-insight]: https://img.shields.io/sensiolabs/i/510c4368-2414-43ae-85e7-486590a4961a.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/58277758/shield

[link-packagist]: https://packagist.org/packages/sven/env-providers
[link-downloads]: https://packagist.org/packages/sven/env-providers
[link-codeclimate]: https://codeclimate.com/github/svenluijten/env-providers
[link-quality]: https://scrutinizer-ci.com/g/svenluijten/env-providers/?branch=master
[link-insight]: https://insight.sensiolabs.com/projects/510c4368-2414-43ae-85e7-486590a4961a
[link-styleci]: https://styleci.io/repos/58277758
