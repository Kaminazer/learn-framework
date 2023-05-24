<?php

namespace App\Services;

use Core\Interfaces\RouteInterface;

class Router implements RouteInterface
{
    public function route(): callable
    {
        return function () {
            echo 'Hello world!!!';
        };
    }
}