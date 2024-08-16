<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    echo __('messages.welcome');
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

Route::post('api/auth/login', 'AuthController@login');
Route::get('api/auth/logout', 'AuthController@logout');

Route::get('api/profile', ['uses' => 'ProfileController@readAll']);
Route::get('api/profile/{id:\d+}', ['uses' => 'ProfileController@read']);
Route::post('api/profile', ['middleware' => 'auth', 'uses' => 'ProfileController@create']);
Route::put('api/profile/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileController@update']);
Route::delete('api/profile/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileController@delete']);

Route::get('api/profile-attribute', ['uses' => 'ProfileAttributeController@readAll']);
Route::get('api/profile-attribute/{id:\d+}', ['uses' => 'ProfileAttributeController@read']);
Route::post('api/profile-attribute', ['middleware' => 'auth', 'uses' => 'ProfileAttributeController@create']);
Route::put('api/profile-attribute/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileAttributeController@update']);
Route::delete('api/profile-attribute/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileAttributeController@delete']);
