<?php

namespace Sven\EnvProviders;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as BaseProvider;

class EnvServiceProvider extends BaseProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/providers.php' => config_path('providers.php'),
        ], 'config');
    }

    public function register(): void
    {
        $providerGroups = $this->app['config']->get('providers', []);

        foreach ($providerGroups as $group) {
            $this->loadProviderGroup($group);
        }
    }

    private function loadProviderGroup(array $group): void
    {
        $environments = Arr::get($group, 'environments', []);

        if (! $this->shouldLoadFrom($environments)) {
            return;
        }

        $this->registerProviders(
            Arr::get($group, 'providers', [])
        );

        $this->registerAliases(
            Arr::get($group, 'aliases', [])
        );
    }

    private function shouldLoadFrom(array $environments): bool
    {
        return in_array($this->app->environment(), $environments, false)
            || in_array('*', $environments, false);
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
}
