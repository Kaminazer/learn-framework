<?php

namespace App\Http\Controllers;

use Core\Application;

class ProductsController
{
    public function index()
    {
        //echo $this->doSomething() . ': ';
        $app = Application::getApp();
        //$app->get('temp')->run();
        echo $app->temp->run();

        $app->logger->debug('Product controller index method is running');
    }

    public function show()
    {
        // Записать лог
        $app = Application::getApp();
        $logger = $app->get('logger');
        $logger->debug('Запустился метод show контроллера ProductController');

        echo __METHOD__;
    }

    /*private function doSomething()
    {
        return 'Hello world';
    }*/
}