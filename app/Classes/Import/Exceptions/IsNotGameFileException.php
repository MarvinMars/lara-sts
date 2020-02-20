<?php

namespace App\Classes\Import\Exceptions;

use Exception;

class IsNotGameFileException extends Exception
{
    public function __construct(string $message = "", string $expected = null, string $got = null)
    {
        $message = sprintf('[%s] is not valid game file.', $message);

        if ($expected) {
            $message .= ' Expected: [' . $expected . ']';
        }

        if ($got) {
            $message .= ' Got: [' . $got . ']';
        }

        parent::__construct($message);
    }

}