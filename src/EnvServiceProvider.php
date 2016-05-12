<?php

namespace Sven\EnvProviders;

use Illuminate\Support\ServiceProvider;

class EnvServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/providers.php' => config_path('providers.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $providerGroups = config('providers', []);

        foreach ($providerGroups as $group) {
            $this->loadProviderGroup($group);
        }
    }

    /**
     * Load in the provider groups.
     *
     * @param array $group The provider group to load in.
     *
     * @return void
     */
    private function loadProviderGroup(array $group)
    {
        $environments = array_get($group, 'environments', []);

        if (!$this->shouldLoadFrom($environments)) {
            return;
        }

        $this->registerProviders(
            array_get($group, 'providers', [])
        );

        $this->registerAliases(
            array_get($group, 'aliases', [])
        );
    }

    /**
     * Determine whether or not the providers and aliases should be loaded.
     *
     * @param array $environments The environments to search.
     *
     * @return bool Whether or not the current environment should load the providers.
     */
    private function shouldLoadFrom(array $environments)
    {
        return in_array($this->app->environment(), $environments) || in_array('*', $environments);
    }

    /**
     * Register the application's service providers.
     *
     * @param array $providers The providers to load in.
     *
     * @return void
     */
    private function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the application's facades.
     *
     * @param array $aliases An associative array of aliases.
     *
     * @return void
     */
    private function registerAliases(array $aliases)
    {
        foreach ($aliases as $alias => $abstract) {
            $this->app->alias($abstract, $alias);
        }
    }
}
