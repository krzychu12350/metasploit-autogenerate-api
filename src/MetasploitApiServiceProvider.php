<?php

namespace Krzychu12350\MetasploitApi;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Krzychu12350\MetasploitApi\Console\InstallMetasploitApiPackage;

class MetasploitApiServiceProvider extends ServiceProvider
{
    public function __construct(Application $app)
    {
        //only for development
        //require_once __DIR__ . '/../vendor/autoload.php';
        parent::__construct($app);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/Config/route-attributes.php' => config_path('route-attributes.php'),
                __DIR__ . '/Config/settings.php' => config_path('settings.php'),
            ], 'Config');
            $this->commands([
                InstallMetasploitApiPackage::class,
            ]);
        }
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
