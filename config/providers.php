<?php

return [

    /**
     * The environment aliases. For example, the "dev" group should be
     * used when the application is in "local" or the "testing" env.
     */
    'environments' => [
        'dev' => ['local', 'testing'],
        'production' => ['prod'],
    ],

    /**
     * The groups that should be loaded when the active application
     * environment is one of the environments configured above.
     */
    'groups' => [
        '*' => [
            'providers' => [],
            'aliases' => [],
        ],

        'dev' => [
            'providers' => [],
            'aliases' => [],
        ],
    ],

];
