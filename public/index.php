<?php

// ВХОДНОЙ СКРИПТ

use Core\Application;

ini_set('display_errors', '1');

include __DIR__ . '/../vendor/autoload.php';

(function () {
    $config = include __DIR__ . '/../config/main.php';

    $app = Application::getApp();

    $app->configure($config);

    $app->main();
})();