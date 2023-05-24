<?php

namespace Core;

use Core\Interfaces\RouteInterface;
use Psr\Log\LoggerInterface;

class Application
{
    /*protected $router;

    protected $logger;*/

    protected static $instance;

    protected $config;

    protected $components = [];

    public static function getApp()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function configure(array $config)
    {
        $this->config = $config;

        foreach ($this->config['components'] as $name => $componentConfig) {
            $className = $componentConfig['class'];
            $instance = new $className();
            $this->components[$name] = $instance;
        }
    }

    public function get(string $name)
    {
        if (isset($this->components[$name])) {
            return $this->components[$name];
        }

        throw new \Exception('Component ' . $name . ' not found');
    }

    private function __construct()
    {
    }

    /*public function __construct(array $config)
    {
        $this->config = $config;
    }*/

    /*public function __construct(
        RouteInterface $router,
        LoggerInterface $logger
    ) {
        $this->router = $router;
        $this->logger = $logger;
    }*/

    public function main()
    {
        $this->get('logger')->debug('Application is running');

        $action = $this->get('router')->route();
        $action();

        $this->get('logger')->debug('End main method');
    }
}