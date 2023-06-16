<?php

namespace Core\Services\Logging;

use Core\Contracts\ComponentFactoryAbstract;

class LoggerFactory extends ComponentFactoryAbstract
{
    protected function createConcrete()
    {
        return new Logger();
    }
}