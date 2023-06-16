<?php

namespace App\Services\Logger;

use Core\Interfaces\ComponentFactoryAbstract;
use Logging\FileWriter;
use Logging\Formatter;
use Logging\Logger;

class NazarLoggerFactory extends ComponentFactoryAbstract
{
    protected function createConcrete()
    {
        $writer = new FileWriter($this->params['fileName'], new Formatter());
        return new Logger($writer);
    }
}