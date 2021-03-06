<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers\Form', 'prefix' => 'form'], function ($api) {
        $api->resource('templates', 'TemplateController');
        $api->resource('forms', 'FormController');
        $api->resource('category', 'CategoryController');
        $api->resource('components', 'ComponentController');
    });
});
