<?php

namespace Core\Services\Routing;

use Core\Interfaces\ComponentFactoryAbstract;
use Core\Interfaces\RouteInterface;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcrete():RouteInterface
    {
        return new Router();
    }
}