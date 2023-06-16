<?php

namespace Core\Services\Routing;

use Core\Interfaces\ComponentFactoryAbstract;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcrete()
    {
        return new Router();
    }
}