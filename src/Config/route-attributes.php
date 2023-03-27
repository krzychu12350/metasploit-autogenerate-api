<?php

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        base_path('vendor\krzychu12350\metasploitapi\src\Http\Controllers') =>[
            'namespace' => 'Krzychu12350\MetasploitApi\Http\Controllers\\',
            'prefix' => 'api',
        ]
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]
];
