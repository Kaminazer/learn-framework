<?php

namespace Core\Services\Routing;

use Core\Interfaces\RouteInterface;

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
            throw new \Exception('Controller not found');
        }

        $controller = new $controllerName();

        if (!empty($segments[1])) {
            $actionName = $segments[1];
        }

        if (!method_exists($controller, $actionName)) {
            throw new \Exception('Method not found');
        }

        //$controller->$actionName();
        //call_user_func([$controller, $actionName]);

        return [$controller, $actionName];
    }

    private function defineControllerName()
    {

    }
}