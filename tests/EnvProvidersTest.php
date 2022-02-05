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
        $this->app['config']->set('providers.groups.*', [
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
        $this->app['config']->set('providers.groups.*', [
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
    public function it_registers_providers_and_aliases_in_the_current_environment(): void
    {
        $this->app['config']->set('providers.environments.dev', ['local']);
        $this->app['config']->set('providers.environments.prod', ['production']);

        $this->app['config']->set('providers.groups.dev', [
            'providers' => [SampleProviderOne::class],
            'aliases' => ['One' => SampleFacadeOne::class],
        ]);

        $this->app['env'] = 'local';
        $this->app->register(ServiceProvider::class);

        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(SampleProviderOne::class, $providers);
        $this->assertArrayNotHasKey(SampleProviderTwo::class, $providers);
        $this->assertTrue($this->app->isAlias('One'));
        $this->assertFalse($this->app->isAlias('Two'));
    }

    /** @test */
    public function it_registers_providers_and_aliases_if_the_environments_contain_a_wildcard(): void
    {
        $this->app['config']->set('providers.environments.dev', ['local']);
        $this->app['config']->set('providers.environments.prod', ['*', 'production']);

        $this->app['config']->set('providers.groups.prod', [
            'providers' => [SampleProviderTwo::class],
            'aliases' => ['Two' => SampleFacadeTwo::class],
        ]);

        $this->app['env'] = 'does-not-matter';
        $this->app->register(ServiceProvider::class);

        $providers = $this->app->getLoadedProviders();

        $this->assertArrayNotHasKey(SampleProviderOne::class, $providers);
        $this->assertArrayHasKey(SampleProviderTwo::class, $providers);
        $this->assertFalse($this->app->isAlias('One'));
        $this->assertTrue($this->app->isAlias('Two'));
    }

    /** @test */
    public function it_registers_providers_and_aliases_if_the_current_environment_is_the_group_key(): void
    {
        $this->app['config']->set('providers.environments.dev', ['local', 'development']);
        $this->app['config']->set('providers.environments.prod', ['production']);

        $this->app['config']->set('providers.groups.dev', [
            'providers' => [SampleProviderTwo::class],
            'aliases' => ['Two' => SampleFacadeTwo::class],
        ]);

        $this->app['env'] = 'dev';
        $this->app->register(ServiceProvider::class);

        $providers = $this->app->getLoadedProviders();

        $this->assertArrayNotHasKey(SampleProviderOne::class, $providers);
        $this->assertArrayHasKey(SampleProviderTwo::class, $providers);
        $this->assertFalse($this->app->isAlias('One'));
        $this->assertTrue($this->app->isAlias('Two'));
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
