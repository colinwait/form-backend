<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::namespace('Form')->group(function ($router) {
    $router->resource('/form/forms', 'FormController');
    $router->resource('/form/category', 'CategoryController');
    $router->resource('/form/templates', 'TemplateController');
    $router->resource('/form/components', 'ComponentController');
    $router->get('/form/show/{id}', 'FormController@showDetail');
});
