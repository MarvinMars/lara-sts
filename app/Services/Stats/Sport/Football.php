<?php

namespace App\Services\Stats\Sport;

use App\Models\Game;
use App\Models\Player;
use App\Models\Season;
use App\Services\Stats\Repositories\Repository;
use App\Services\Stats\Tables\Football\CareerAllPurposeTable;
use App\Services\Stats\Tables\Football\CareerInterceptionsTable;
use App\Services\Stats\Tables\Football\CareerPassingTable;
use App\Services\Stats\Tables\Football\CareerReceivingTable;
use App\Services\Stats\Tables\Football\CareerRushingTable;
use App\Services\Stats\Tables\Football\CareerSacksTable;
use App\Services\Stats\Tables\Football\CareerScoringTable;
use App\Services\Stats\Tables\Football\CareerTotalOffensiveTable;
use App\Services\Stats\Tables\Football\DefensiveCareerTable;
use App\Services\Stats\Tables\Football\DefensiveGameByGameTable;
use App\Services\Stats\Tables\Football\HighsDefensiveTable;
use App\Services\Stats\Tables\Football\HighsTable;
use App\Services\Stats\Tables\Football\OffensiveGameByGameTable;


class Football
{
    /**
     * Highs for the current player and season.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function highs(Player $player, Season $season): Repository
    {
        return (new HighsTable($player, $season))->getRepository();
    }

    /**
     * Defensive highs.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @return \App\Services\Stats\Repositories\Repository
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function highsDefensive(Player $player, Season $season): Repository
    {
        return (new HighsDefensiveTable($player, $season))->getRepository();
    }

    /**
     * Game by game defensive stats.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     *
     * @param \App\Models\Game|null $game
     *
     * @return \App\Services\Stats\Tables\Football\DefensiveGameByGameTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function defensiveGameByGame(Player $player, Season $season, Game $game = null): DefensiveGameByGameTable
    {
        return new DefensiveGameByGameTable($player, $season, $game);
    }


    /**
     * Career defensive stats.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\DefensiveCareerTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function defensiveCareerTable(Player $player, Season $season = null): DefensiveCareerTable
    {
        return new DefensiveCareerTable($player, $season);
    }

    /**
     * Game by game offensive stats.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season $season
     * @param \App\Models\Game|null $game
     *
     * @return \App\Services\Stats\Tables\Football\OffensiveGameByGameTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function offensiveGameByGame(Player $player, Season $season, Game $game = null): OffensiveGameByGameTable
    {
        return new OffensiveGameByGameTable($player, $season, $game);
    }

    /**
     * Career rushing stats.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerRushingTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerRushingTable(Player $player, Season $season = null): CareerRushingTable
    {
        return new CareerRushingTable($player, $season);
    }

    /**
     * Career scoring stats.
     *
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerScoringTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerScoringTable(Player $player, Season $season = null): CareerScoringTable
    {
        return new CareerScoringTable($player, $season);
    }

    /**
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerTotalOffensiveTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerTotalOffensiveTable(Player $player, Season $season = null): CareerTotalOffensiveTable
    {
        return new CareerTotalOffensiveTable($player, $season);
    }

    /**
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerPassingTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerPassingTable(Player $player, Season $season = null): CareerPassingTable
    {
        return new CareerPassingTable($player, $season);
    }

    /**
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerSacksTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerSacksTable(Player $player, Season $season = null): CareerSacksTable
    {
        return new CareerSacksTable($player, $season);
    }

    /**
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerInterceptionsTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerInterceptionsTable(Player $player, Season $season = null): CareerInterceptionsTable
    {
        return new CareerInterceptionsTable($player, $season);
    }

    /**
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerReceivingTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerReceivingTable(Player $player, Season $season = null): CareerReceivingTable
    {
        return new CareerReceivingTable($player, $season);
    }

    /**
     * @param \App\Models\Player $player
     * @param \App\Models\Season|null $season
     *
     * @return \App\Services\Stats\Tables\Football\CareerAllPurposeTable
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public function careerAllPurposeTable(Player $player, Season $season = null): CareerAllPurposeTable
    {
        return new CareerAllPurposeTable($player, $season);
    }
}