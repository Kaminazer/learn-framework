<?php

/**
 * @var \App\Services\Routing\RouterAdapter $this
 */

$this->router->get('/', 'App\Http\Controllers\IndexController@index');

$this->router->get('/products', 'App\Http\Controllers\ProductsController@index');