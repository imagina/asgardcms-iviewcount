<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/iviewcounts'], function (Router $router) {
    $router->bind('count', function ($id) {
        return app('Modules\Iviewcounts\Repositories\CountRepository')->find($id);
    });
    $router->get('counts', [
        'as' => 'admin.iviewcounts.count.index',
        'uses' => 'CountController@index',
        'middleware' => 'can:iviewcounts.counts.index'
    ]);
    $router->get('counts/create', [
        'as' => 'admin.iviewcounts.count.create',
        'uses' => 'CountController@create',
        'middleware' => 'can:iviewcounts.counts.create'
    ]);
    $router->post('counts', [
        'as' => 'admin.iviewcounts.count.store',
        'uses' => 'CountController@store',
        'middleware' => 'can:iviewcounts.counts.create'
    ]);
    $router->get('counts/{count}/edit', [
        'as' => 'admin.iviewcounts.count.edit',
        'uses' => 'CountController@edit',
        'middleware' => 'can:iviewcounts.counts.edit'
    ]);
    $router->put('counts/{count}', [
        'as' => 'admin.iviewcounts.count.update',
        'uses' => 'CountController@update',
        'middleware' => 'can:iviewcounts.counts.edit'
    ]);
    $router->delete('counts/{count}', [
        'as' => 'admin.iviewcounts.count.destroy',
        'uses' => 'CountController@destroy',
        'middleware' => 'can:iviewcounts.counts.destroy'
    ]);
// append

});
