<?php

                use Illuminate\Http\Request;
                use Illuminate\Support\Facades\Route;
                use Krzychu12350\MetasploitApi\Http\Controllers\ConsoleApiController;
use Krzychu12350\MetasploitApi\Http\Controllers\ModuleApiController;

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
                Route::group(['prefix' => 'api', 'middleware' => 'api'], function (){
                    Route::get('test', function (){
                       return 'testttttt';
                    });
                    Route::get('/modules/options', [ModuleApiController::class, 'options']);
                });


