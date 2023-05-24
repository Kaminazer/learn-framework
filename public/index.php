<?php

// ВХОДНОЙ СКРИПТ

use Core\Application;
use Core\Services\Routing\Router;
use Psr\Log\AbstractLogger;

ini_set('display_errors', '1');

include __DIR__ . '/../vendor/autoload.php';

/*$router = new Router();
//$router = new \App\Services\Router();
$app = new Application($router, new class() extends AbstractLogger {
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        file_put_contents(__DIR__ . '/../logs/log.txt', $message . PHP_EOL, FILE_APPEND);
    }
});*/



(function () {
    $config = include __DIR__ . '/../config/main.php';

    $app = Application::getApp();

    $app->configure($config);

    $app->main();
})();