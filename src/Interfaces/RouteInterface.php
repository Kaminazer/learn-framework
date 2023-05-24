<?php

namespace Core\Interfaces;

interface RouteInterface
{
    public function route(): callable;
}