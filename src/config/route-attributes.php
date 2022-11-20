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
        //pure Laravel, it works
        dirname(__FILE__) . '../Http/Controllers',
        //package path, it doesn't work
        //base_path('package/MetasploitApi/src/Http/Controllers'),
        /*
        app_path('Http/Controllers/Api') => [
           'prefix' => 'api',
           'middleware' => 'api',
        ],
        */
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class
    ]
];
