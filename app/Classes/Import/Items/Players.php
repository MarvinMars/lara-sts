<?php

namespace App\Classes\Import\Items;

use App\Classes\Import\Classes\AbstractImport;
use App\Classes\Import\Interfaces\Import;
use App\Models\Game;
use App\Models\Import as ImportModel;
use App\Models\Player;
use App\Models\PlayerType;
use App\Models\PlayerValue;
use App\Models\Team;
use Illuminate\Support\Collection;

/**
 * Class Players
 * @package App\Classes\Import\Items
 */
class Players extends AbstractImport implements Import
{
    protected $gameId;
    protected $team;

    public function __construct(ImportModel $import, Game $gameModel, Team $teamModel)
    {
        parent::__construct($import);

        $this->gameId = $gameModel->id;
        $this->team = $teamModel;
    }

    /**
     * Read items from the specific files
     */
    public function read()
    {
        $this->data = collect();
        if ($data = $this->xml->get('team')) {
            if (!is_array($data)) {
                $this->log('Wrong data in team', 'error');

                return $this;
            }
            //looking for players
            foreach ($data as $team => $item) {
                if (!is_array($item)) {
                    continue;
                }
                $team_id_status = false;
                if (!empty ($this->allowed_team_id) && $this->team->shortcode) {
                    foreach ($this->allowed_team_id as $id) {
                        if (strcasecmp($this->team->shortcode, $id) === 0) {
                            $team_id_status = true;
                        }
                    }
                }
                if ($team_id_status) {
                    $this->setPlayers($item, $this->team);
                } else {
                    $this->log(sprintf('Skip %s\'s players', $this->team->shortcode));
                }
            }
        }

        return $this;
    }

    /**
     * Working with the items
     */
    public function processing()
    {
        foreach ($this->data->all() as $item) {
            if (!is_array($item)) {
                continue;
            }
            $item = collect($item);
            $model = null;

            $name = $item->get('checkname', $item->get('name'));

            if ($name) {
                $this->log('    Searching player by attributes (team_id, sport_id, checkname)', 'info');
                $model = Player::where([
                    'team_id' => $this->team->id,
                    'sport_id' => $this->import->sport_id,
                    'checkname' => $name
                ])->first();

                if (!$model) {
                    $this->log('    Searching player by attributes (sport_id, checkname)', 'info');
                    $model = Player::where([
                        'sport_id' => $this->import->sport_id,
                        'checkname' => $name
                    ])->first();
                }
            } else {
                $this->log('    Skipping player without name', 'error');
                continue;
            }


            if (!$model) {
                $this->log('    Creating new player', 'info');
                $model = new Player();

                foreach ($item as $attr => $value) {
                    $attr = $this->_parseAttribute($attr);
                    if ($model->isFillable($attr)) {
                        $model->setAttribute($attr, $value);
                    }
                }

                $model->checkname = $name;
            }

            if (!$model->sport_id) {
                $model->sport_id = $this->import->sport_id;
            }

            if (!$model->team_id) {
                $model->team_id = $this->team->id;
            }


            try {
                if ($model->save()) {
                    $this->log(
                        sprintf(
                            '      Player [%s] from team [%s] saved',
                            $model->name,
                            $model->team->title
                        )
                    );

                    $gamePlayed = !!intval($item->get('gp', 0));

                    if ($this->gameId && $gamePlayed) {
                        $model->games()->syncWithoutDetaching($this->gameId);
                        $model->seasons()->syncWithoutDetaching($this->import->season_id);
                        $this->_saveValues($model, $item->toArray());
                        $this->setPlayerType($model, $item);
                    }
                } else {
                    $this->log('Player does not saved', 'error');
                }

                $this->row[] = $model;
            } catch (\Exception $e) {
                $this->log($e->getMessage(), 'error');
            }
        }

        return $this;
    }

    /**
     * Saving player values to the database.
     *
     * @param Player $model
     * @param array $item
     *
     * @throws \Exception
     */
    private function _saveValues(Player $model, array $item)
    {
        $this->log(sprintf('    Saving player values for %d', $model->id));
        //delete old values for the selected game
        PlayerValue::wherePlayerId($model->id)->whereGameId($this->gameId)->delete();

        $itemsToSave = [];

        if ($values = $this->_parseValues($item)) {
            foreach ($values as $value) {
                $numValue = 0;

                if (is_numeric($value['value'])) {
                    $numValue = $value['value'];
                }

                $itemsToSave[] = [
                    'game_id' => $this->gameId,
                    'player_id' => $model->id,
                    'group' => $value['group'],
                    'key' => $value['key'],
                    'value' => $numValue,
                    'raw_value' => $value['value'],
                    'context' => $value['context'],
                ];
            }
        }
        $start = microtime(true);
        if ($itemsToSave) {
            PlayerValue::insert($itemsToSave);
        }
        $end = microtime(true) - $start;
        $this->log(sprintf('        Player\'s values saved for [%d]. Seconds: %s', $model->id, round($end, 3)));
    }


    /**
     * Parse player values and preparing the array for them.
     *
     * @param array $item
     * @param string $currentGroup
     * @param null $context
     *
     * @return array
     */
    private function _parseValues(array $item, string $currentGroup = 'player', $context = null): array
    {
        $result = [];
        foreach ($item as $group => $value) {
            if (!is_array($value)) {
                $result[] = [
                    'group' => $currentGroup,
                    'key' => $this->_parseAttribute($group),
                    'context' => $context,
                    'value' => $value,
                ];
            } else {
                $currentContext = null;
                if (isset($value['@context'])) {
                    $currentContext = $value['@context'];
                    unset($value['@context']);
                }
                $result = array_merge($result,
                    $this->_parseValues($value, (!is_numeric($group) ? $group : $currentGroup),
                        $currentContext));
            }
        }

        return $result;
    }

    /**
     * Parsing players.
     *
     * @param array $item
     * @param \App\Models\Team $team
     */
    private function setPlayers(array $item, Team $team): void
    {
        $item = collect($item);

        if ($playersArray = $item->get('player', [])) {
            $players = collect($playersArray)->map(function ($item) use ($team) {
                if (!is_array($item)) {
                    return $item;
                }

                $result = [];
                foreach ($item as $key => $value) {
                    $result[$this->_parseAttribute($key)] = $value;
                }

                return $result;
            });

            $this->data = $this->data->merge($players);
        }
    }

    /**
     * Set the player type based on his position.
     *
     * @param \App\Models\Player $player
     * @param \Illuminate\Support\Collection $collection
     */
    private function setPlayerType(Player $player, Collection $collection): void
    {
        if ($player->playerType) {
            return;
        }

        if (!$this->import->sport->type) {
            return;
        }

        $position =
            $collection->get('opos',
                $collection->get('dpos',
                    $collection->get('pos')));

        if (!$position) {
            return;
        }

        $this->log(sprintf('Position found: %s', $position), 'info');

        $playerType = PlayerType::where([
            'name' => strtoupper($position)
        ])->whereHas('sportBlocks', function ($query) {
            $query->where('sport_type', $this->import->sport->type);
        })->first();

        if ($playerType) {
            $player->update(['player_type_id' => $playerType->id]);
            $this->log(sprintf('Set position: %s.', $position), 'info');
        } else {
            $this->log(sprintf('Position %s not exists.', $position), 'error');
        }
    }
}
