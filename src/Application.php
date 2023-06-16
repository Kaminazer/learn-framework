<?php

/**
 * Файл класса приложения бла-бла-бла...
 *
 * @author Yurii Orlyk <aigletter@gmail.com>
 * @version 1.0.0
 */

namespace Core;

use Core\Exceptions\HttpException;
use Core\Contracts\Creator;
use Core\Contracts\RouteInterface;
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
class Application extends Creator
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
    protected array $config;

    /**
     * Привязки имен сервисов и фабрик, которые умеют их создавать.
     *
     * Используется при создании экземпляров сервисов.
     *
     * @see Application::make()
     * @var array
     */
    protected array $bindings = [];

    /**
     * @var array
     */

    /**
     * Метод паттерна "Одиночка", с помощью которого клиенты получают экземпляр класса
     *
     * @link https://en.wikipedia.org/wiki/Singleton_pattern
     * @return Application
     * @todo Избавиться от синглтона в будущем
     */
    public static function getApp():Application
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
    public function configure(array $config):void
    {
        // Здесь я делаю то-то и то-то для того-то и того-то
        $this->config = $config;

        foreach ($this->config['components'] as $name => $componentConfig) {
            $this->bindings[$name] = $componentConfig;
        }
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
     * Основная функция запуска приложения
     *
     * Данная функция запускает роутинг и все остальное...
     *
     * @return void
     * @throws \Exception
     */
    public function main():void
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