<?php

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

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

$router->group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin'], function () use ($router) {
    $router->get('/', ['uses' => 'IndexController@index', 'as' => 'index']);
    $router->group(['prefix' => 'books', 'as' => 'books'], function () use ($router) {
        $router->get('add/', ['uses' => 'BookController@create', 'as' => 'add']);
        $router->post('add/', ['uses' => 'BookController@create', 'as' => 'add']);
        $router->get('delete/{id}', ['uses' => 'BookController@delete', 'as' => 'delete']);
        $router->get('update/{id}', ['uses' => 'BookController@update', 'as' => 'update']);
        $router->post('update/{id}', ['uses' => 'BookController@update', 'as' => 'update']);
    });
    $router->group(['prefix' => 'authors', 'as' => 'authors'], function () use ($router) {
        $router->get('add/', ['uses' => 'AuthorsController@create', 'as' => 'add']);
        $router->post('add/', ['uses' => 'AuthorsController@create', 'as' => 'add']);
        $router->get('delete/{id}', ['uses' => 'AuthorsController@delete', 'as' => 'delete']);
        $router->get('update/{id}', ['uses' => 'AuthorsController@update', 'as' => 'update']);
        $router->post('update/{id}', ['uses' => 'AuthorsController@update', 'as' => 'update']);
    });
});

$router->group(['namespace' => 'Api', 'prefix' => 'api/v1', 'as' => 'api'], function () use ($router) {
    /** I think here should be uniform interface `books` for all endpoints even if on a task said different way
     * on a real project i would prefer to discuss it, maybe i am missing some stuff
     */
    $router->group(['prefix' => 'books', 'as' => 'books'], function () use ($router) {
        $router->get('/', ['uses' => 'BookController@show', 'as' => 'show']);
        $router->get('/{id}', ['uses' => 'BookController@showById', 'as' => 'showById']);
        /** I think here should be PATCH but in a task set POST (same case that with uniform interface) */
        $router->patch('/{id}', ['uses' => 'BookController@update', 'as' => 'update']);
        $router->delete('/{id}', ['uses' => 'BookController@delete', 'as' => 'delete']);
    });
});
