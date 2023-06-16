<?php

namespace Core\Services\Temp;

class Test
{
    protected $inner;

    public function __construct(Inner $inner, int $size)
    {
        $this->inner = $inner;
    }

    public function run()
    {
        return 'Temp component is running';
    }
}