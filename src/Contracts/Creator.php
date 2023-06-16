<?php

namespace Core\Contracts;

abstract class Creator
{
    protected array $components = [];
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
    public function get(string $name):object
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
    protected function make(string $name):object
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
}