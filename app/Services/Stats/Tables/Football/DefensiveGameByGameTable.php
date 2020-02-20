<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Football\DefensiveTrait;
use App\Services\Stats\Traits\GameByGameQueryTrait;

class DefensiveGameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, DefensiveTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return array
     *
     */
    protected function build(): array
    {
        $result = [
            $this->tacklesSolo(), //SOLO TACKLES
            $this->tacklesAst(), //AST TACKLES
            $this->tacklesStfl(), //SFTL TACKLES
            $this->tacklesAtfl(), //ATFL TACKLES
            $this->tacklesTfl(), //TFL TACKLES
            $this->tacklesYds(), //YDS TACKLES
            $this->tacklesTotal(), //TOTAL TACKLES

            $this->sacksTotal(), //TOTAL SACKS
            $this->sacksYds(), //YDS SACKS

            $this->fumblesFf(), //FF FUMBLES
            $this->fumblesFr(), //FR FUMBLES
            $this->fumblesYds(), //YDS FUMBLES

            $this->intsTotal(), //TOTAL INTS
            $this->intsYds(), //YDS INTS

            $this->passesQbh(), //QBH PASSES
            $this->passesBrk(), //BRK PASSES

            $this->blocksKick(), //KICK BLOCKS
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'SOLO',
            'AST',
            'STFL',
            'ATFL',
            'TFL',
            'YDS',
            'TOTAL',
            'TOTAL',
            'YDS',
            'FF',
            'FR',
            'YDS',
            'TOTAL',
            'YDS',
            'QBH',
            'BRK',
            'KICK',
        ];
    }


}