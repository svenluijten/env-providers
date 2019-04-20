<?php

namespace Sven\EnvProviders\Tests;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider as BaseProvider;
use Sven\EnvProviders\ServiceProvider;

class EnvProvidersTest extends TestCase
{
    /** @test */
    public function it_registers_all_providers_in_wildcard_group(): void
    {
        $this->app['config']->set('providers.0', [
            'environments' => ['*'],
            'providers' => [SampleProviderOne::class, SampleProviderTwo::class],
            'aliases' => [],
        ]);

        $this->app->register(ServiceProvider::class);

        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(SampleProviderOne::class, $providers);
        $this->assertArrayHasKey(SampleProviderTwo::class, $providers);
    }

    /** @test */
    public function it_registers_all_aliases_in_a_wildcard_group(): void
    {
        $this->app['config']->set('providers.0', [
            'environments' => ['*'],
            'providers' => [],
            'aliases' => [
                'One' => SampleFacadeOne::class,
                'Two' => SampleFacadeTwo::class,
            ],
        ]);

        $this->app->register(ServiceProvider::class);

        $this->assertTrue($this->app->isAlias('One'));
        $this->assertTrue($this->app->isAlias('Two'));
    }

    /** @test */
    public function it_only_registers_providers_and_aliases_if_in_the_current_environment_group(): void
    {
        $this->app['config']->set('providers.0', [
            'environments' => ['staging'],
            'providers' => [SampleProviderOne::class],
            'aliases' => ['Two' => SampleFacadeTwo::class],
        ]);

        $this->app['config']->set('providers.1', [
            'environments' => ['production'],
            'providers' => [SampleProviderTwo::class],
            'aliases' => ['One' => SampleFacadeOne::class],
        ]);

        $this->app['env'] = 'staging';

        $this->app->register(ServiceProvider::class);

        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(SampleProviderOne::class, $providers);
        $this->assertArrayNotHasKey(SampleProviderTwo::class, $providers);
        $this->assertTrue($this->app->isAlias('Two'));
        $this->assertFalse($this->app->isAlias('One'));
    }
}

class SampleProviderOne extends BaseProvider
{
    //
}

class SampleProviderTwo extends BaseProvider
{
    //
}

class SampleFacadeOne extends Facade
{
    //
}

class SampleFacadeTwo extends Facade
{
    //
}
