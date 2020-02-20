<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Interfaces\HighsTableInterface;
use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

/**
 * Class HighsDefensiveTable
 * @package App\Services\Stats\Tables\Football
 */
class HighsDefensiveTable extends AbstractTable implements HighsTableInterface
{
    use HighsQueryTrait;

    /**
     * Return the highs methods names.
     *
     * @return array
     */
    public function highsData(): array
    {
        return [
            'tackles',
            'interceptions',
        ];
    }


    public function tackles()
    {
        return $this->first('defense', ['tackua', 'tacka']);
    }

    public function interceptions()
    {
        return $this->first('defense', 'int');
    }
}