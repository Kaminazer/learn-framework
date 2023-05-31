<?php

namespace Core\Services\Logging;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    /**
     * @param $level
     * @param \Stringable|string $message
     * @param array $context
     * @return void
     * @todo Сделать нормальную реализацию данного сервиса
     */
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        file_put_contents(__DIR__ . '/../../../logs/log.txt', $message . PHP_EOL, FILE_APPEND);
    }
}