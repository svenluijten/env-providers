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
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $environments = collect([
            'dev' => ['local', 'dev', 'development'],
            'staging' => ['staging', 'testing', 'test'],
            'production' => ['production', 'live', 'prod'],
        ]);

        $environments->each(function ($key, $value) {
            dd($value);
        });
    }
}
