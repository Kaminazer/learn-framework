<?php

namespace Core\Contracts;

interface RouteInterface
{
    public function route(): callable;
}