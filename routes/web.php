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

$router->group(['middleware' => 'client.credentials'],function () use ($router){
    /**
     * Author's Routes
     */
    $router->get('/authors', 'AuthorController@index');
    $router->post('/authors', 'AuthorController@store');
    $router->get('/authors/{author}', 'AuthorController@show');
    $router->put('/authors/{author}', 'AuthorController@update');
    $router->patch('/authors/{author}', 'AuthorController@update');
    $router->delete('/authors/{author}', 'AuthorController@destroy');
    /**
     * Books's Routes
     */
    $router->get('/books', 'BooksController@index');
    $router->post('/books', 'BooksController@store');
    $router->get('/books/{book}', 'BooksController@show');
    $router->put('/books/{book}', 'BooksController@update');
    $router->patch('/books/{book}', 'BooksController@update');
    $router->delete('/books/{book}', 'BooksController@destroy');

    /**
     * Books's Routes
     */
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{user}', 'UserController@show');
    $router->put('/users/{user}', 'UserController@update');
    $router->patch('/users/{user}', 'UserController@update');
    $router->delete('/users/{user}', 'UserController@destroy');
    /**
     * User Credentials protected routes
     */
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{user}', 'UserController@show');
    $router->put('/users/{user}', 'UserController@update');
    $router->patch('/users/{user}', 'UserController@update');
    $router->delete('/users/{user}', 'UserController@destroy');
});

$router->group(['middleware' => 'auth:api'], function () use ($router){
    /**
     * User Credentials protected routes
     */
    $router->get('/users/me', 'UserController@me');


});

