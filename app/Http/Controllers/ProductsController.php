<?php

namespace App\Http\Controllers;

use Core\Application;

class ProductsController
{
    public function index()
    {
        //echo $this->doSomething() . ': ';
        echo Application::getApp()->get('temp')->run();
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