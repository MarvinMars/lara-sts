<?php

namespace App\Services\Stats\Interfaces;

interface HighsTableInterface
{
    /**
     * Return the highs methods names.
     *
     * @return array
     */
    public function highsData(): array;
}