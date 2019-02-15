<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/counts'], function (Router $router) {
  
    $router->get('/', [
        'as' => 'api.iviewcounts.count.index',
        'uses' => 'CountController@index',
    ]);
    $router->get('create', [
        'as' => 'api.iviewcounts.count.create',
        'uses' => 'CountController@create',

    ]);
    $router->post('/', [
        'as' => 'api.iviewcounts.count.store',
        'uses' => 'CountController@store',

    ]);
  
    $router->put('{count}', [
        'as' => 'api.iviewcounts.count.update',
        'uses' => 'CountController@update',

    ]);
    $router->delete('{count}', [
        'as' => 'api.iviewcounts.count.destroy',
        'uses' => 'CountController@destroy',

    ]);
// append

});
