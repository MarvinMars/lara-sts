<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\DefensiveTrait;

class DefensiveCareerTable extends AbstractTable
{
    use CareerQueryTrait, DefensiveTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return array
     *
     */
    protected function build(): array
    {
        $result = [
            $this->gp(), //GP
            $this->tacklesSolo(), //SOLO TACKLES
            $this->tacklesAst(), //AST TACKLES
            $this->tacklesTotal(), //TOTAL TACKLES
            $this->tacklesTfl(), //TFL TACKLES
            $this->tacklesYds(), //YDS TACKLES
            $this->intsTotal(), //TOTAL INTS
            $this->fumblesFf(), //FF FUMBLES
            $this->fumblesFr(), //FR FUMBLES
            $this->blocksKick(), //KICK BLOCKS
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'UA',
            'A',
            'TOT',
            'TFL',
            'TFLY',
            'INT',
            'FF',
            'FR',
            'BLK',
        ];
    }


}