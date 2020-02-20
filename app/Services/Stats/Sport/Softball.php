<?php

namespace App\Services\Stats\Sport;

use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Repositories\Repository;
use App\Services\Stats\Tables\Softball\Fielding;
use App\Services\Stats\Tables\Softball\Highs;
use App\Services\Stats\Tables\Softball\Hitting;
use App\Services\Stats\Tables\Softball\Pitching;
use App\Services\Stats\Tables\Softball\PitchingHighs;

/**
 * Class Softball
 * @package App\Services\Stats
 */
class Softball
{
    /**
     * Get player's highs for the current player and season.
     *
     * @param Player $player
     * @param Season $season
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function highs(Player $player, Season $season): Repository
    {
        return (new Highs($player, $season))->getRepository();
    }

    /**
     * Get player's pitching highs for the current player and season.
     *
     * @param Player $player
     * @param Season $season
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function pitchingHighs(Player $player, Season $season): Repository
    {
        return (new PitchingHighs($player, $season))->getRepository();
    }

    /**
     * Return pitching values for the current player and season.
     *
     * @param Player $player
     * @param Season $season
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function pitching(Player $player, Season $season = null): Repository
    {
        return (new Pitching($player, $season))->getRepository();
    }


    /**
     * Hitting values for the current player and current game.
     *
     * @param Player $player
     * @param Season $season
     * @param Game $game
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function hitting(Player $player, Season $season, Game $game = null): Repository
    {
        return (new Hitting($player, $season, $game))->getRepository();
    }


    /**
     * Fielding values for the current player and current game.
     *
     * @param Player $player
     * @param Season $season
     * @param Game $game
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function fielding(Player $player, Season $season, Game $game = null): Repository
    {
        return (new Fielding($player, $season, $game))->getRepository();
    }
}