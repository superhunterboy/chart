<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->get('/all-success-pay', 'HomeController@allSuccessPay');
    $router->get('/pull-success-pay', 'HomeController@pullSuccessPay');
    $router->get('/pay-success-table', 'HomeController@paySuccessTable');
    $router->get('/pull-success-table', 'HomeController@pullSyccessTable');
    $router->resource('online-pay', 'BbinPayOnlineController');
});