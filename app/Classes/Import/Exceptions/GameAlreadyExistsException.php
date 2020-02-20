<?php

namespace App\Classes\Import\Exceptions;

class GameAlreadyExistsException extends \Exception
{
    public function __construct(string $gameId)
    {
        $msg = sprintf('Game [%s] already exists.', $gameId);
        parent::__construct($msg);
    }

}