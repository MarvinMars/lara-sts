<?php

namespace App\Services\Stats\Sport;

use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Repositories\Repository;
use App\Services\Stats\Tables\Baseball\FieldingCareerTable;
use App\Services\Stats\Tables\Baseball\FieldingGameByGameTable;
use App\Services\Stats\Tables\Baseball\HittingCareerTable;
use App\Services\Stats\Tables\Baseball\HittingGameByGameTable;
use App\Services\Stats\Tables\Baseball\HittingHighsTable;
use App\Services\Stats\Tables\Baseball\PitchingCareerTable;
use App\Services\Stats\Tables\Baseball\PitchingGameByGameTable;
use App\Services\Stats\Tables\Baseball\PitchingHighsTable;

/**
 * Class Baseball
 * @package App\Services\Stats
 */
class Baseball
{
    /**
     * Get player's highs for the current player and season.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function highs(Player $player, Season $season): Repository
    {
        return (new HittingHighsTable($player, $season))->getRepository();
    }

    /**
     * Get player's pitching highs for the current player and season.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function pitchingHighs(Player $player, Season $season): Repository
    {
        return (new PitchingHighsTable($player, $season))->getRepository();
    }

    /**
     * Return pitching values for the current player and season.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function pitching(Player $player, Season $season = null): Repository
    {
        return (new PitchingCareerTable($player, $season))->getRepository();
    }

    /**
     * Return pitching values for the current player, season and game.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     * @param \App\Models\Game|null $game
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function pitchingGameByGame(Player $player, Season $season, Game $game = null): Repository
    {
        return (new PitchingGameByGameTable($player, $season, $game))->getRepository();
    }


    /**
     * Hitting values for the current player and current game.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     * @param \App\Models\Game|null $game
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function hitting(Player $player, Season $season, Game $game = null): Repository
    {
        return (new HittingGameByGameTable($player, $season, $game))->getRepository();
    }

    /**
     * Hitting career values.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function hittingCareer(Player $player, Season $season = null): Repository
    {
        return (new HittingCareerTable($player, $season))->getRepository();
    }


    /**
     * Fielding values for the current player and current game.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     * @param \App\Models\Game|null $game
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function fielding(Player $player, Season $season, Game $game = null): Repository
    {
        return (new FieldingGameByGameTable($player, $season, $game))->getRepository();
    }


    /**
     * Fielding career table.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function fieldingCareer(Player $player, Season $season = null): Repository
    {
        return (new FieldingCareerTable($player, $season))->getRepository();
    }
}