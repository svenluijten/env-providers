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
        $shouldLoadDevProviders = in_array(
            $this->app->environment(),
            config('providers.development_environments') ?: []
        );

        if ($shouldLoadDevProviders) {
            foreach (config('providers.load') as $provider) {
                $this->app->register($provider);
            }
        }
    }
}
