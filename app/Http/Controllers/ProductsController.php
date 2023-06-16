<?php

namespace App\Http\Controllers;

use Core\Application;

class ProductsController
{
    public function index():void
    {
        $app = Application::getApp();
        echo $app->temp->run();

        $app->logger->debug('Product controller index method is running');
    }

    public function show():void
    {
        // Записать лог
        $app = Application::getApp();
        $logger = $app->get('logger');
        $logger->debug('Запустился метод show контроллера ProductController');
        echo __METHOD__;
    }
}
