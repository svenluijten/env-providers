<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Provider Group
     |--------------------------------------------------------------------------
     |
     | A list of providers and aliases to register in matching environments.
     |
     */

    [
        /*
         |--------------------------------------------------------------------------
         | Environments
         |--------------------------------------------------------------------------
         |
         | Environments this group will be registered in. Groups that include the '*'
         | environment will always be registered.
         |
         */

        'environments' => '*',

        'providers' => [
            // Foo\Bar\AllEnvServiceProvider::class,
        ],

        'aliases' => [
            // 'AllEnvFacade' => Foo\Bar\AllEnvFacade::class,
        ],
    ],
    [

        'environments' => 'production',

        'providers' => [
            // Foo\Bar\ProdServiceProvider::class,
        ],

        'aliases' => [
            // 'ProdFacade' => Foo\Bar\ProdFacade::class,
        ],
    ],
    [

        'environments' => ['dev', 'local'],

        'providers' => [
            // Foo\Bar\DevServiceProvider::class,
        ],

        'aliases' => [
            // 'DevFacade' => Foo\Bar\DevFacade::class,
        ],
    ],


];
