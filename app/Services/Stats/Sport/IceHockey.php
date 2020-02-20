<?php

namespace App\Services\Stats\Sport;

use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Repositories\Repository;
use App\Services\Stats\Tables\IceHockey\CareerTable;
use App\Services\Stats\Tables\IceHockey\GameByGameTable;
use App\Services\Stats\Tables\IceHockey\GoalkeepingCareerTable;
use App\Services\Stats\Tables\IceHockey\GoalkeepingGameByGameTable;
use App\Services\Stats\Tables\IceHockey\Highs;
use App\Services\Stats\Tables\IceHockey\HighsGoalkeeping;

/**
 * Class IceHockey
 * @package App\Services\Stats
 */
class IceHockey
{
    /**
     * Get player's highs goalkeeping for the current player and season.
     *
     * @param Player $player
     * @param Season $season
     *
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function goalkeepingHighs(Player $player, Season $season = null): Repository
    {
        return (new HighsGoalkeeping($player, $season))->getRepository();
    }

    /**
     * Get player's highs for the current player and season.
     *
     * @param Player $player
     * @param Season $season
     *
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function highs(Player $player, Season $season = null): Repository
    {
        return (new Highs($player, $season))->getRepository();
    }

    /**
     * Get player's career statistics for the current season.
     *
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function career(Player $player, Season $season = null): Repository
    {
        return (new CareerTable($player, $season))->getRepository();
    }

    /**
     * Goalkeeping career stats.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerGoalkeeping(Player $player, Season $season = null): Repository
    {
        return (new GoalkeepingCareerTable($player, $season))->getRepository();
    }

    /**
     * Get player's game by game goalkeeping values.
     *
     * @param Player $player
     * @param Season $season
     * @param Game $game
     *
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function goalkeepingGameByGame(Player $player, Season $season, Game $game = null): Repository
    {
        return (new GoalkeepingGameByGameTable($player, $season, $game))->getRepository();
    }

    /**
     * Player's game by game stats.
     *
     * @param Player $player
     * @param Season $season
     * @param Game|null $game
     *
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function gameByGame(Player $player, Season $season, Game $game = null): Repository
    {
        return (new GameByGameTable($player, $season, $game))->getRepository();
    }
}