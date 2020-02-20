<?php

namespace App\Classes\Import\Exceptions;

use Exception;

class NotSupportedSportException extends Exception
{
    public function __construct(string $message = "")
    {
        $message = sprintf('Sport [%s] not supported yet.', $message);
        parent::__construct($message);
    }

}