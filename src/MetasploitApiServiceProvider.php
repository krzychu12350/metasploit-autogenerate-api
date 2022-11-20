<?php

namespace Krzychu12350\MetasploitApi;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Krzychu12350\Phpmetasploit\AuthApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;


class MetasploitApiServiceProvider extends ServiceProvider
{

    public function __construct(Application $app)
    {
        require_once __DIR__.'/../vendor/autoload.php';
        //var_dump(realpath(__DIR__));
        /*
        $app = new Application(
            realpath(__DIR__)
        );
        */

        parent::__construct($app);



        $userPassword = "pass123";
        $ssl = "true";
        $userName = "user";
        $ip = "127.0.0.1";
        $port = 55553;
        $webServerURI = "/api/1.0";
        $c = new MsfRpcClient($userPassword,$ssl,$userName,$ip,$port, $webServerURI);
        $token = $c->msfAuth();


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->app->useAppPath(realpath('E:\Zlecenia\metasploit-api\package\MetasploitApi\src'));
        //dd(app_path());

       // $this->app->register('Krzychu12350\Phpmetasploit\ConsoleApiMethods');
        //$this->loadRoutesFrom(__DIR__ . '/routes/api.php');


        $this->publishes([
            __DIR__.'/../config/route-attributes.php' => config_path('route-attributes.php'),
        ]);


        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        //controllers, api routes, form requests


        //$this->app->register($c);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Krzychu12350\MetasploitApi\Http\Controllers\AuthApiController');




        /*
     * Register the service provider for the dependency.
     */
        /*
        $this->app->bind('Discover', function ($app) {
            return new \Spatie\RouteDiscovery\Discovery\Discover();
        });
        */
        /*
        $this->app->bind('Route', function ($app) {
            return new \Spatie\RouteDiscovery\Attributes\Route();
        });

        */
        //$this->app->bind(AuthApiMethods::class);

        /*
         * Create aliases for the dependency.
         */
        //$loader = \Illuminate\Foundation\AliasLoader::getInstance();

        //$loader->alias('Discover', \Spatie\RouteDiscovery\Discovery\Discover::class);
       // $loader->alias('AuthApiMethods', \Krzychu12350\Phpmetasploit\AuthApiMethods::class);
       // $loader->alias('ResourceServer', 'LucaDegasperi\OAuth2Server\Facades\ResourceServerFacade');




    }
}
