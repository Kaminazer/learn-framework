<?php

namespace Core\Exceptions;

class NotFoundException extends HttpException
{
    protected $message = 'Not found';

    protected $code = 404;
}