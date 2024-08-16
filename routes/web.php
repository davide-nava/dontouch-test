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

use App\Events\AccessOperationEvent;
use Illuminate\Support\Facades\Event;

$router->get('/', function () use ($router) {
    Event::dispatch(new AccessOperationEvent('Home'));

    return   __('messages.welcome');
});

$router->get('/version', function () use ($router) {
    Event::dispatch(new AccessOperationEvent('Version'));

    return $router->app->version();
});

$router->post('api/auth/login', 'AuthController@login');
$router->get('api/auth/logout', 'AuthController@logout');

$router->get('api/profile', ['uses' => 'ProfileController@readAll']);
$router->get('api/profile/{id:\d+}', ['uses' => 'ProfileController@read']);
$router->post('api/profile', ['middleware' => 'auth', 'uses' => 'ProfileController@create']);
$router->put('api/profile/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileController@update']);
$router->delete('api/profile/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileController@delete']);

$router->get('api/profileattribute', ['uses' => 'ProfileAttributeController@readAll']);
$router->get('api/profileattribute/{id:\d+}', ['uses' => 'ProfileAttributeController@read']);
$router->post('api/profileattribute', ['middleware' => 'auth', 'uses' => 'ProfileAttributeController@create']);
$router->put('api/profileattribute/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileAttributeController@update']);
$router->delete('api/profileattribute/{id:\d+}', ['middleware' => 'auth', 'uses' => 'ProfileAttributeController@delete']);
