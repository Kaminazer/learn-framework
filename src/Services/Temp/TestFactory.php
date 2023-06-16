<?php

namespace Core\Services\Temp;

use Core\Interfaces\ComponentFactoryAbstract;

class TestFactory extends ComponentFactoryAbstract
{
    protected function createConcrete()
    {
        return new Test(new Inner(), $this->params['size']);
    }
}