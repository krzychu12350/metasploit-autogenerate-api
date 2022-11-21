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
        //spatie/laravel-route-attributes package
        //local laravel package development path
        //'Krzychu12350\MetasploitApi\Http\Controllers\\' => base_path('package/MetasploitApi/src/Http/Controllers'),

        //laravel vendor directory path
        //'Krzychu12350\MetasploitApi\Http\Controllers\\' => base_path('vendor\krzychu12350\metasploitapi\src\Http\Controllers'),



        base_path('vendor\krzychu12350\metasploitapi\src\Http\Controllers') =>[
            'namespace' => 'Krzychu12350\MetasploitApi\Http\Controllers\\',
            'prefix' => 'api',
        ]



        //pure Laravel, it works
       // dirname(__FILE__) . '../Http/Controllers',

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
