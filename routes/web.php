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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello-mahdani/{name}', function ($name) { return "<h1>Lumen</h1><p>Hi <b>" . $name ."</b></p>"; });

$router->get('/tabel_mhs','Tabel_mhsController@index');

$router->post('/tabel_mhs/store','Tabel_mhsController@store');

$router->put('/tabel_mhs/update/{id}','Tabel_mhsController@update');

$router->delete('/tabel_mhs/delete/{id}','Tabel_mhsController@delete');