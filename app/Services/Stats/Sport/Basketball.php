<?php
namespace App\Services\Stats\Sport;

use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Repositories\Repository;

use App\Services\Stats\Tables\Basketball\GameByGameTable;
use App\Services\Stats\Tables\Basketball\HighsTable;
use App\Services\Stats\Tables\Basketball\CareerTable;


/**
 * Class Basketball
 * @package App\Services\Stats
 */
class Basketball
{
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

    public function gameByGameTable(Player $player, Season $season, Game $game = null): Repository
    {
        return (new GameByGameTable($player, $season, $game))->getRepository();
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

    public function careerTable(Player $player, Season $season = null, Game $game = null): Repository
    {
        return (new CareerTable($player, $season, $game))->getRepository();
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

    public function highsTable(Player $player, Season $season, Game $game = null): Repository
    {
        return (new HighsTable($player, $season, $game))->getRepository();
    }
}