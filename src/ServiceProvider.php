<?php

namespace Sven\EnvProviders;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/providers.php' => config_path('providers.php'),
        ], 'config');
    }

    public function register(): void
    {
        $providerGroups = $this->config('providers.groups', []);

        foreach ($providerGroups as $environment => $group) {
            $this->loadProviderGroup($group, $environment);
        }
    }

    private function loadProviderGroup(array $group, string $environment): void
    {
        if (!$this->shouldLoad($environment)) {
            return;
        }

        $this->registerProviders(
            Arr::get($group, 'providers', [])
        );

        $this->registerAliases(
            Arr::get($group, 'aliases', [])
        );
    }

    private function shouldLoad(string $environment): bool
    {
        $environments = [
            ...$this->config('providers.environments.'.$environment, []),
            $environment,
        ];

        return in_array('*', $environments, strict: false)
            || in_array($this->app->environment(), [...$environments, $environment], strict: false);
    }

    private function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    private function registerAliases(array $aliases): void
    {
        foreach ($aliases as $alias => $abstract) {
            $this->app->alias($abstract, $alias);
        }
    }

    private function config(string $key, mixed $default)
    {
        return $this->app['config']->get($key, $default);
    }
}
