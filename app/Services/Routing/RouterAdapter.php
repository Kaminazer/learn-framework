<?php

namespace App\Services\Routing;

use Bramus\Router\Router;
use Core\Interfaces\RouteInterface;

class RouterAdapter implements RouteInterface
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    protected function addRoutes()
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/../routes/web.php';
    }

    public function route(): callable
    {
        $this->addRoutes();

        return function () {
            $this->router->run();
        };
    }
}