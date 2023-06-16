<?php

namespace Core\Interfaces;

abstract class ComponentFactoryAbstract
{
    /**
     * Параметры компонента, которые приходят из конфигов
     * @var array
     */
    protected $params;

    /**
     * @param array $params Параметры компонента
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * Метод, через который клиентский код взаимодействует с фабриками
     * Реализация паттерна "Фабричный метод"
     *
     * @return mixed
     */
    public function create()
    {
        return $this->createConcrete();
    }

    /**
     * Абстрактный метод, который делегирует создание конкретных объектов наследникам текущего класса
     * Реализация паттерна "Фабричный метод"
     *
     * @return mixed
     */
    abstract protected function createConcrete();
}