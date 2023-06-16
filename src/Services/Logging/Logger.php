<?php

namespace Core\Services\Logging;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        file_put_contents(__DIR__ . '/../../../logs/log.txt', $message . PHP_EOL, FILE_APPEND);
    }
}