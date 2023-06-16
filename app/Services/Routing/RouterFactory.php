<?php

namespace App\Services\Routing;

use Bramus\Router\Router;
use Core\Contracts\ComponentFactoryAbstract;
use Core\Contracts\RouteInterface;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcrete():RouteInterface
    {
        return new RouterAdapter(new Router());
    }
}