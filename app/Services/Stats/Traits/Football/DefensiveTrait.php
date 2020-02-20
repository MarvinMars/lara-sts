<?php

namespace App\Services\Stats\Traits\Football;

trait DefensiveTrait
{
    /**
     * Tackles data.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function tacklesSolo(bool $format = true)
    {
        return $this->sum('defense', 'tackua', $format);
    }

    /**
     * Tackles data.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function tacklesAst(bool $format = true)
    {
        return $this->sum('defense', 'tacka', $format);
    }

    /**
     * Tackles data.
     *
     * @return float|string
     */
    private function tacklesTotal()
    {
        return $this->tacklesSolo(false) + $this->tacklesAst(false);
    }

    /**
     * Tackles data.
     *
     * @return float|string
     */
    private function tacklesTfl()
    {
        $stfl = $this->tacklesStfl(false);
        $atfl = $this->tacklesAtfl(false) * 0.5;

        return $stfl + $atfl;
    }

    /**
     * ATFL tackles.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function tacklesAtfl(bool $format = true)
    {
        return $this->sum('defense', 'tfla', $format);
    }


    private function tacklesStfl(bool $format = true)
    {
        return $this->sum('defense', 'tflua', $format);
    }

    /**
     * Tackles data.
     *
     * @return float|string
     */
    private function tacklesYds()
    {
        return $this->sum('defense', 'tflyds');
    }

    /**
     * Sacks data.
     *
     * @return mixed
     */
    private function sacksTotal()
    {
        return number_format($this->sacksUa(false) + $this->sacksA(false));
    }

    /**
     * Sacks data.
     *
     * @return float|string
     */
    private function sacksYds()
    {
        return $this->sum('defense', 'sackyds');
    }

    /**
     * Sacks data.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function sacksUa(bool $format = true)
    {
        return $this->sum('defense', 'sackua', $format);
    }

    /**
     * Sacks data.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function sacksA(bool $format = true)
    {
        $result = $this->sum('defense', 'sacka', false) * 0.5;

        return $format ? number_format($result) : $result;
    }

    /**
     * @return float|string
     */
    private function fumblesYds()
    {
        return $this->sum('defense', 'fryds');
    }

    /**
     * @return float|string
     */
    private function fumblesFr()
    {
        return $this->sum('defense', 'fr');
    }

    /**
     * @return float|string
     */
    private function fumblesFf()
    {
        return $this->sum('defense', 'ff');
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    private function intsTotal(bool $format = true)
    {
        return $this->sum('defense', 'int', $format);
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    private function intsYds(bool $format = true)
    {
        return $this->sum('defense', 'intyds', $format);
    }


    /**
     * @return float|string
     */
    private function passesQbh()
    {
        return $this->sum('defense', 'qbh');
    }

    /**
     * @return float|string
     */
    private function passesBrk()
    {
        return $this->sum('defense', 'brup');
    }

    /**
     * @return float|string
     */
    private function blocksKick()
    {
        return $this->sum('defense', 'blkd');
    }

    /**
     * @return float|int
     */
    public function defenseAvgR()
    {
        $ints = $this->intsTotal(false);
        $intYards = $this->intsYds(false);

        return ((float)$ints > 0 ? ($intYards / $ints) : 0);
    }

    /**
     * @return float|int
     */
    public function defenseAvgG()
    {
        $gp = $this->gp();
        $intYards = $this->intsYds();

        return ((float)$gp > 0 ? ($intYards / $gp) : 0);
    }
}