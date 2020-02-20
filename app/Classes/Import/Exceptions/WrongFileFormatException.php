<?php

namespace App\Classes\Import\Exceptions;

use Exception;

class WrongFileFormatException extends Exception
{
    public function __construct(string $message = "")
    {
        $message = sprintf('[%s] is not valid XML file', $message);
        parent::__construct($message);
    }

}