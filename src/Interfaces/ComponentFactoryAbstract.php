<?php

namespace Core\Interfaces;

abstract class ComponentFactoryAbstract
{
    protected $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function create()
    {
        return $this->createConcrete();
    }

    abstract protected function createConcrete();
}