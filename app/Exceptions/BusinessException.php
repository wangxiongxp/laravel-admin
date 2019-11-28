<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    function __construct($msg = "")
    {
        parent::__construct($msg);
    }

}
