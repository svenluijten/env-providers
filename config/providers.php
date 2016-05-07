<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    |
    | Here you may determine what providers and aliases
    | get loaded when your application's environment
    | equals any of the environments further down.
    |
    */
    'load' => [
        'providers' => [
            // Foo\Bar\FooBarServiceProvider::class,
        ],

        'aliases' => [
            // 'Facade' => Foo\Bar\Facade::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Development Environments
    |--------------------------------------------------------------------------
    |
    | Here you can determine in what environments the above
    | ServiceProviders should be loaded. You may add your
    | own, but we've assumed sensible defaults. Simple.
    |
    */
    'development_environments' => ['dev', 'development', 'local'],
];
