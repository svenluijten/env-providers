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

        $groups = config('providers', []);

        foreach($groups as $group){
            $groupEnvironments = (array) array_get($group, 'environments', []);

            if($this->groupMatchesEnvironment($groupEnvironments)){
                $providers = array_get($group, 'providers', []);
                $aliases = array_get($group, 'aliases', []);

                $this->registerProviders($providers);
                $this->registerAliases($aliases);
            }
        }
    }

    /**
     * Register the development Service Providers.
     * @param array $providers
     */
    protected function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the development aliases / facades.
     * @param array $aliases
     */
    protected function registerAliases(array $aliases)
    {
        foreach ($aliases as $abstract => $alias) {
            $this->app->alias($abstract, $alias);
        }
    }

    /**
     * @param string|array $groupEnvironments
     * @return bool
     */
    protected function groupMatchesEnvironment($groupEnvironments)
    {
        $groupEnvironments = (array)$groupEnvironments;
        if(in_array('*', $groupEnvironments)){
            return true;
        }

        if(in_array($this->app->environment(), $groupEnvironments)){
            return true;
        }

        return false;
    }

}
