<?php

namespace Core\Services\Routing;

use Core\Contracts\ComponentFactoryAbstract;
use Core\Contracts\RouteInterface;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcrete():RouteInterface
    {
        return new Router();
    }
}