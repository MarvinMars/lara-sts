<?php

namespace App\Services\Stats\Sport;

use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Repositories\Repository;

use App\Services\Stats\Tables\Soccer\GameByGame;
use App\Services\Stats\Tables\Soccer\GameByGameGoalkeeping;

use App\Services\Stats\Tables\Soccer\CareerGoalkeeping;
use App\Services\Stats\Tables\Soccer\CareerScoringStats;

use App\Services\Stats\Tables\Soccer\Highs;
use App\Services\Stats\Tables\Soccer\HighsGoalkeeping;

/**
 * Class Soccer
 * @package App\Services\Stats
 */
class Soccer
{

    /**
     * Get player's career statistics for the current season.
     *
     * @param Player $player
     * @param Season $season
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */

    public function careerGoalkeeping(Player $player, Season $season = null): Repository
    {
        return (new CareerGoalkeeping($player, $season))->getRepository();
    }


    /**
     * Get player's career statistics for the current season.
     *
     * @param Player $player
     * @param Season $season
     * @return Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */

    public function careerScoringStats(Player $player, Season $season = null): Repository
    {
        return (new CareerScoringStats($player, $season))->getRepository();
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

    public function gameByGame(Player $player, Season $season, Game $game = null): Repository
    {
        return (new GameByGame($player, $season, $game))->getRepository();
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

    public function gameByGameGoalkeeping(Player $player, Season $season, Game $game = null): Repository
    {
        return (new GameByGameGoalkeeping($player, $season, $game))->getRepository();
    }


    /**
     * Hitting values for the current player and current game.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */

    public function highs(Player $player, Season $season): Repository
    {
        return (new Highs($player, $season))->getRepository();
    }

    /**
     * Hitting values for the current player and current game.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */

    public function highsGoalkeeping(Player $player, Season $season): Repository
    {
        return (new HighsGoalkeeping($player, $season))->getRepository();
    }

}