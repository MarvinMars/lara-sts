<?php

namespace App\Classes\Import\Items;

use App\Classes\Import\Classes\AbstractImport;
use App\Classes\Import\Exceptions\MissingTeamException;
use App\Classes\Import\Interfaces\Import;
use App\Models\Game;
use App\Models\Import as ImportModel;
use App\Models\Team;

/**
 * Class Teams
 * @package App\Classes\Import\Items
 */
class Teams extends AbstractImport implements Import
{

    protected $gameId;
    protected $gameModel;

    public function __construct(ImportModel $import, Game $gameModel)
    {
        parent::__construct($import);

        $this->gameModel = $gameModel;
        $this->gameId = $gameModel->id;
    }

    /**
     * Read items from the specific files
     */
    public function read()
    {
        //Looking for team data
        if ($read = $this->xml->has('team')) {
            $data = $this->xml->get('team');
            if (count($data) && is_array($data)) {
                $this->data = collect($data)->map(function ($item) {
                    if (!is_array($item)) {
                        return $item;
                    }
                    $result = [];
                    foreach ($item as $key => $value) {
                        $result[$this->_parseAttribute($key)] = $value;
                    }

                    return $result;
                });
            }
        }

        return $this;
    }

    /**
     * Working with the teams.
     *
     * @return \App\Classes\Import\Items\Teams
     * @throws \App\Classes\Import\Exceptions\IsNotGameFileException
     * @throws \App\Classes\Import\Exceptions\MissingTeamException
     * @throws \App\Classes\Import\Exceptions\WrongFileFormatException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Nathanmac\Utilities\Parser\Facades\Exceptions\ParserException
     * @throws \App\Classes\Import\Exceptions\NotSupportedSportException
     */
    public function processing()
    {
        if ($this->checkTeams()) {
            foreach ($this->data->all() as $item) {
                if (!is_array($item)) {
                    continue;
                }
                $item = collect($item);
                $model = null;
                $teamId = $item->get('id', null);
                $teamName = $item->get('name', null);

                if ($teamId) {
                    if (in_array($teamId, $this->allowed_team_id)) {
                        $teamId = array_first($this->allowed_team_id);
                    }

                    //First trying get team with code (NCAA ID)
                    if ($code = $item->get('code')) {
                        $model = Team::where([
                            'code' => $code,
                            'shortcode' => $teamId
                        ])->first();
                    }

                    //If nothing found - trying get it by shortcode and by title.
                    if (!$model && $teamName) {
                        $model = Team::where([
                            'shortcode' => $teamId,
                            'title' => $teamName
                        ])->first();
                    }

                    //Then trying get team only by shortcode (can be dangerous)
                    if (!$model) {
                        $model = Team::whereShortcode($teamId)->first();
                    }

                    //Then trying get team only by name (can be super dangerous)
                    if (!$model && $teamName) {
                        $model = Team::whereTitle($teamName)->first();
                    }
                } else {
                    $this->log('Team without code.');
                    continue;
                }

                if ($model instanceof Team) {
                    $this->log(sprintf('Team [%s] already exists', $model->title), 'info');
                } else {
                    $this->log('New team');
                    $model = new Team();

                    foreach ($item as $attr => $value) {
                        $attr = $this->_parseAttribute($attr);
                        if ($model->isFillable($attr) && !empty($value)) {
                            $model->setAttribute($attr, $value);
                        }
                    }
                }

                if ($teamId && !$model->shortcode) {
                    $model->shortcode = $teamId;
                }

                if ($model->save()) {
                    if ($this->gameModel->teams->count() < 2) {
                        $this->gameModel->teams()->syncWithoutDetaching($model->id);
                    } else {
                        $this->log(sprintf('Game could not has more than 2 teams at same time'), 'error');
                        $this->notify('[MANUAL CHECK] Truing assign more than two teams on game', [
                            'file' => $this->filePath,
                            'data' => [
                                'Game' => $this->gameModel->id,
                                'Date' => $this->gameModel->date,
                                'Team' => $model->id,
                                'Team Name' => $model->title
                            ],
                        ]);
                    }

                    if (in_array($model->shortcode, Team::teamIds())) {
                        (new Players($this->import, $this->gameModel, $model))
                            ->setFile($this->filePath)
                            ->read()
                            ->processing();
                    } else {
                        $this->gameModel->opponent_name = $teamName;
                        $this->gameModel->opponent_code = $teamId;
                        $this->gameModel->save();

                        $this->log(sprintf('Skip %s\'s players', $model->shortcode), 'info');
                    }
                } else {
                    $this->log(sprintf('Team [%s] does not saved', $model->title), 'error');
                }
                $this->row[] = $model;
            }
        } else {
            $this->notify('[MANUAL CHECK] File without school teams', [
                'file' => $this->filePath,
                'data' => $this->data->pluck('id')->toJson(),
            ]);

            throw new MissingTeamException(sprintf('Missing teams in %s', $this->filePath));
        }

        return $this;
    }

    /**
     * Check that we have any team predefined name.
     *
     * @return bool
     */
    private function checkTeams(): bool
    {
        return $this->data->pluck('id')->filter(function ($code) {
            return in_array($code, Team::teamIds());
        })->isNotEmpty();
    }


}
