<?php

namespace Core\Services\Routing;

use Core\Exceptions\NotFoundException;
use Core\Contracts\RouteInterface;

class Router implements RouteInterface
{
    public function route(): callable
    {
        $controllerName = 'IndexController';
        $actionName = 'index';

        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $segments = explode('/', $path);

        if (!empty($segments[0])) {
            $controllerName =  ucfirst($segments[0]) . 'Controller';
        }

        $controllerName = 'App\\Http\\Controllers\\' . $controllerName;
        if (!class_exists($controllerName)) {
            throw new NotFoundException('Controller not found');
        }

        $controller = new $controllerName();

        if (!empty($segments[1])) {
            $actionName = $segments[1];
        }

        if (!method_exists($controller, $actionName)) {
            throw new NotFoundException('Method not found');
        }

        return [$controller, $actionName];
    }
}