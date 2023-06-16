<?php

namespace Core;

use Core\Exceptions\HttpException;

class Application
{
    /*protected $router;

    protected $logger;*/

    protected static $instance;

    protected $config;

    protected $bindings = [];

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
            $this->bindings[$name] = $componentConfig;
        }
    }

    public function get(string $name)
    {
        if (isset($this->components[$name])) {
            return $this->components[$name];
        }

        if (isset($this->bindings[$name])) {
            return $this->make($name);
        }

        throw new \Exception('Component ' . $name . ' not found');
    }

    protected function make($name)
    {
        $factoryClassName = $this->bindings[$name]['factory'];
        $params = $this->bindings[$name]['params'] ?? [];
        $factory = new $factoryClassName($params);
        $instance = $factory->create();
        $this->components[$name] = $instance;

        return $instance;
    }

    private function __construct()
    {
    }
    

    public function main()
    {
        $this->get('logger')->debug('Application is running');

        try {
            $action = $this->get('router')->route();
            $action();
        } catch (HttpException $exception) {
            http_response_code($exception->getCode());
            echo $exception->getMessage();
        } catch (\Throwable $exception) {
            http_response_code(500);
            echo 'Server error';
        }


        $this->get('logger')->debug('End main method');
    }
}