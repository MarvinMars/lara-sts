<?php

namespace App\Classes\Import\Items;

use App\Classes\Import\Classes\AbstractImport;
use App\Classes\Import\Exceptions\GameAlreadyExistsException;
use App\Classes\Import\Interfaces\Import;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Games
 * @package App\Classes\Import\Items
 */
class Games extends AbstractImport implements Import
{

    /**
     * Read items from the specific files
     */
    public function read()
    {
        if ($this->xml->has('games')) {
            $data = collect($this->xml->get('games'));
            if (isset($data['game']) && count($data['game'])) {
                $this->data = collect($data['game']);
            }
        } elseif ($this->xml->has('venue')) {
            $data = $this->xml->get('venue');
            if (isset($data['@gameid'])) {
                $this->data = collect([$data]);
            }
        }

        return $this;
    }

    /**
     * Working with the games.
     * We are saving only new games because if game already exists in the database it can not has the duplicates.
     * Right now we are checking this by date, start and sport_id first or by gameid and sport_id.
     * If game doesn't exist it creates a new model and with this model we can work only. Otherwise we can't create duplicates of the games.
     *
     * @return \App\Classes\Import\Items\Games
     * @throws \App\Classes\Import\Exceptions\MissingTeamException
     * @throws \App\Classes\Import\Exceptions\WrongFileFormatException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Nathanmac\Utilities\Parser\Facades\Exceptions\ParserException
     * @throws \App\Classes\Import\Exceptions\IsNotGameFileException
     * @throws \App\Classes\Import\Exceptions\GameAlreadyExistsException
     * @throws \App\Classes\Import\Exceptions\NotSupportedSportException
     */
    public function processing()
    {
        foreach ($this->data->all() as $item) {
            if (!is_array($item)) {
                continue;
            }
            $item = collect($item)->map(function ($value) {
                if (is_string($value)) {
                    return trim($value);
                }
                return $value;
            });

            $model = $this->getGameModel($item);

            foreach ($item as $attr => $value) {
                $attr = $this->_parseAttribute($attr);
                if ($model->isFillable($attr)) {
                    try {
                        $model->setAttribute($attr, $value);
                    } catch (\Exception $e) {
                        $this->log(sprintf('Error: %s', $e->getMessage()), 'error');
                    }
                }
            }
            $model->sport_id = $this->import->sport_id;

            if ($model->save()) {
                $this->log(sprintf('Game [%s] saved with id [%d]', $model->gameid, $model->id));
                $model->seasons()->sync([$this->import->season_id]);

                (new Teams($this->import, $model))
                    ->setFile($this->filePath)
                    ->read()
                    ->processing();
            } else {
                $this->log(sprintf('Game %s could not save', $model->gameid), 'error');
            }

            $this->row[] = $model;
        }

        return $this;
    }

    /**
     * Get game model. It can already exists in the database or can be a new model..
     *
     * @param \Illuminate\Support\Collection $item
     *
     * @return \App\Models\Game
     * @throws \App\Classes\Import\Exceptions\GameAlreadyExistsException
     */
    private function getGameModel(Collection $item): Game
    {
        $gameId = $item->get('@gameid');

        if (!$gameId) {
            $this->log('Game does not has gameid', 'error');
            return null;
        }

        /**
         * If model doesn't exists try to find game in the current sport by date, time and stadium which can not exists in any case.
         */
        $query = Game::where('sport_id', '=', $this->import->sport_id);

        $date = $item->get('@date');

        if ($date && false !== strtotime($date)) {
            $query->whereDate('date', '=', Carbon::parse($date));
        }

        $start = $item->get('@start', null);

        if ($start) {
            try {
                $start = Carbon::parse($start);
                $query->whereTime('start', '=', $start);
            } catch (\Exception $e) {
                $this->log(sprintf('Error occurred on start attribute: %s', $e->getMessage()), 'error');
            }
        }

        /**
         * First trying get full definition of the event. If it exists we can skip this game.
         */
        $fullQuery = clone $query;

        $stadium = $item->get('@stadium');

        if (null !== $stadium) {
            $fullQuery->where('stadium', '=', $stadium);
        }

        $site = $item->get('site', null);

        if (null !== $site) {
            $fullQuery->where('site', '=', $site);
        }

        $existGameModel = $fullQuery->first();

        if ($existGameModel) {
            $this->log(sprintf('Game found by full query (stadium, site, time, date) [%s]', $gameId), 'info');
            throw new GameAlreadyExistsException($gameId);
        }

        /**
         * If full definition is not found we can try find it by gameid too.
         */
        $query->where('gameid', '=', $gameId);

        $existGameModel = $query->first();

        if ($existGameModel) {
            $this->log(sprintf('Game found by game id [%s]', $gameId), 'info');
            throw new GameAlreadyExistsException($gameId);
        }


        $this->log(sprintf('Creating new game [%s]', $gameId), 'info');
        return new Game([
            'gameid' => $gameId,
        ]);
    }
}
