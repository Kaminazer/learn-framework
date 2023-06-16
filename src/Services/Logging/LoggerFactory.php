<?php

namespace Core\Services\Logging;

use Core\Interfaces\ComponentFactoryAbstract;

class LoggerFactory extends ComponentFactoryAbstract
{
    protected function createConcrete()
    {
        return new Logger();
    }
}