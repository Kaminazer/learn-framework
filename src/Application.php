<?php

/**
 * Файл класса приложения бла-бла-бла...
 *
 * @author Yurii Orlyk <aigletter@gmail.com>
 * @version 1.0.0
 */

namespace Core;

use Core\Exceptions\HttpException;
use Core\Interfaces\RouteInterface;
use Core\Services\Temp\Test;
use Psr\Log\LoggerInterface;

/**
 * Класс, который содержит главную функцию для запуска приложения
 *
 * Данный класс является реализацией контейнера.
 * Для его конфигурации нужно вызнать метод configure...
 *
 * @package Core
 * @property Test $temp
 * @property LoggerInterface $logger
 * @property RouteInterface $route
 */
class Application
{
    /*protected $router;

    protected $logger;*/

    /**
     * Статическое свойство, содержащее экземпляр паттерна "Одиночка"
     *
     * @var Application
     */
    protected static $instance;

    /**
     * Массив конфигов
     * @var array
     */
    protected $config;

    /**
     * Привязки имен сервисов и фабрик, которые умеют их создавать.
     *
     * Используется при создании экземпляров сервисов.
     *
     * @see Application::make()
     * @var array
     */
    protected $bindings = [];

    /**
     * @var array
     */
    protected $components = [];

    /**
     * Метод паттерна "Одиночка", с помощью которого клиенты получают экземпляр класса
     *
     * @link https://en.wikipedia.org/wiki/Singleton_pattern
     * @return Application
     * @todo Избавиться от синглтона в будущем
     */
    public static function getApp()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Конфигурация приложения (в основном для определения связки компонентов и их фабрик)
     *
     * @param array $config Массив с конфигами компонентов
     * @return void
     * @example $app->configure([
     *   'components' => [
     *      'logger' = [
     *          'factory' => LoggerFactory::class,
     *      [
     *   ]
     * ])
     */
    public function configure(array $config)
    {
        // Здесь я делаю то-то и то-то для того-то и того-то
        $this->config = $config;

        foreach ($this->config['components'] as $name => $componentConfig) {
            $this->bindings[$name] = $componentConfig;
        }
    }

    public function __get(string $name)
    {
        return $this->get($name);
    }

    /**
     * Метод, возвращающий экземпляр компонента по его имени
     *
     * Если обращение к сервису происходит впервые, он будет создан с помощью метода make
     * В противном случае, возвращается ранее созданный экземпляр
     *
     * @uses \Core\Application::$bindings
     * @uses \Core\Application::make()
     * @param string $name
     * @return mixed
     * @throws \Exception
     * @todo Вынести в отдельный класс, и отнаследоваться от этого нового класса
     */
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

    /**
     * Метод создает экземпляр компонента
     *
     * @param string $name
     * @return object
     * @todo Вынести в отдельный класс, и отнаследоваться от этого нового класса
     */
    protected function make($name)
    {
        // Получаем класс фабрики по связке "название компонента - его фабрика"
        $factoryClassName = $this->bindings[$name]['factory'];
        // Определяем были ли в конфигах параметры для текущего компонента
        $params = $this->bindings[$name]['params'] ?? [];
        // Создаем экземпляр фабрики
        $factory = new $factoryClassName($params);
        // Создаем экземпляр компонента, используя публичный метод фабрик (паттерн "Factory method")
        $instance = $factory->create();
        // Сохраняем созданный экземпляр компонента, для дальнейшего использования, если кому-либо понадобиться в будущем
        $this->components[$name] = $instance;

        return $instance;
    }

    /**
     * Закрытый конструктор для реализации паттерна Singleton
     *
     * @see Application::getApp()
     */
    private function __construct()
    {
    }

    /**
     * Пример некоторого устаревшего метода, который будет удален в будущем
     * @deprecated
     * @see Application::boo()
     * @return void
     */
    public function foo()
    {
        //
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

    /**
     * Основная функция запуска приложения
     *
     * Данная функция запускает роутинг и все остальное...
     *
     * @return void
     * @throws \Exception
     */
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
            echo '<p style="color: red">Server error</p>';
        }

        $this->get('logger')->debug('End main method');
    }
}