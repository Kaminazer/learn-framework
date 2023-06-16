<?php

namespace App\Services\Logger;

use Core\Contracts\ComponentFactoryAbstract;
use Logging\FileWriter;
use Logging\Formatter;
use Logging\Logger;
use Psr\Log\LoggerInterface;

class NazarLoggerFactory extends ComponentFactoryAbstract
{
    protected function createConcrete():LoggerInterface
    {
        $writer = new FileWriter($this->params['fileName'], new Formatter());
        return new Logger($writer);
    }
}