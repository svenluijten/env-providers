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
        $shouldLoadProviders = in_array(
            $this->app->environment(),
            config('providers.development_environments') ?: []
        );

        if ($shouldLoadProviders) {
            foreach (config('providers.load.providers') as $provider) {
                $this->app->register($provider);
            }

            foreach (config('providers.load.aliases') as $abstract => $alias) {
                $this->app->alias($abstract, $alias);
            }
        }
    }
}
