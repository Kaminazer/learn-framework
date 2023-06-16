<?php

namespace App\Services\Routing;

use Bramus\Router\Router;
use Core\Interfaces\ComponentFactoryAbstract;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcrete()
    {
        return new RouterAdapter(new Router());
    }
}