<?php

namespace App\Services\Routing;

use Bramus\Router\Router;
use Core\Interfaces\ComponentFactoryAbstract;
use Core\Interfaces\RouteInterface;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcrete():RouteInterface
    {
        return new RouterAdapter(new Router());
    }
}