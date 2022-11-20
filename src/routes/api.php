<?php

                use Illuminate\Http\Request;
                use Illuminate\Support\Facades\Route;
                use Krzychu12350\MetasploitApi\Http\Controllers\ConsoleApiController;
use Krzychu12350\MetasploitApi\Http\Controllers\ModuleApiController;
//use Spatie\RouteDiscovery\Discovery\Discover;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/
//var_dump(base_path('package\\MetasploitApi\\src\\Http\\Controllers'));
var_dump(app_path());
//Discover::controllers()->in(app_path('..\package\MetasploitApi\src\Http\Controllers'));
//var_dump(Discover::controllers()->useRootNamespace('Krzychu12350\MetasploitApi\Http\Controllers'));
            /*
                Route::group(['prefix' => 'api', 'middleware' => 'api'], function (){
                    Route::get('/modules/options', [ModuleApiController::class, 'options']);
                });
*/
