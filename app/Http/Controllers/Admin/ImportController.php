<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Import\Factories\ImportFactory;
use App\Models\Import;

class ImportController extends Controller
{
    protected $data = [];

    public function processing(int $id)
    {
        /** @var Import $importItem */
        $importItem = Import::findOrFail($id);

        return $this->_stepRedirect($importItem, null);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function processingGames(int $id)
    {
        /** @var Import $importItem */
        $importItem = Import::findOrFail($id);

        if ($redirect = $this->_stepRedirect($importItem, Import::STATUS_UPLOADED)) {
            return $redirect;
        }

        /** @var \App\Classes\Import\Types\Base\Games $gamesFactory */
        $gamesFactory = ImportFactory::create('Games', $importItem);

        $this->data = [
            'importItem' => $importItem,
            'items'      => $gamesFactory->read()->processing()->all(),
            'title'      => trans_choice('stats.games', 2),
        ];

        $this->_statusUpdate($importItem, Import::STATUS_GAMES);


        return view('import.processing', $this->data);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function processingTeams(int $id)
    {
        /** @var Import $importItem */
        $importItem = Import::findOrFail($id);

        if ($redirect = $this->_stepRedirect($importItem, Import::STATUS_GAMES)) {
            return $redirect;
        }

        /** @var \App\Classes\Import\Types\Base\Teams $teamsFactory */
        $teamsFactory = ImportFactory::create('Teams', $importItem);

        $this->_statusUpdate($importItem, Import::STATUS_TEAMS);

        $this->data = [
            'importItem' => $importItem,
            'items'      => $teamsFactory->read()->processing()->all(),
            'title'      => trans_choice('stats.teams', 2),
        ];


        return view('import.processing', $this->data);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function processingPlayers(int $id)
    {
        /** @var Import $importItem */
        $importItem = Import::findOrFail($id);

        if ($redirect = $this->_stepRedirect($importItem, Import::STATUS_TEAMS)) {
            return $redirect;
        }

        /** @var \App\Classes\Import\Types\Base\Players $playersFactory */
        $playersFactory = ImportFactory::create('Players', $importItem);

        $this->data = [
            'importItem' => $importItem,
            'items'      => $playersFactory->read()->processing()->all(),
            'title'      => trans_choice('stats.players', 2),
        ];

        $this->_statusUpdate($importItem, Import::STATUS_PLAYERS);


        return view('import.processing', $this->data);
    }

    public function processingDone(int $id)
    {
        /** @var Import $importItem */
        $importItem = Import::findOrFail($id);

        if ($redirect = $this->_stepRedirect($importItem, Import::STATUS_PLAYERS)) {
            return $redirect;
        }

        $this->_statusUpdate($importItem, Import::STATUS_DONE);

        return redirect(route('crud.import.index'));
    }

    private function _stepRedirect(Import $importItem, $expected)
    {
        $redirect = false;
        if ($importItem->status !== $expected) {
            switch ($importItem->status) {
                case Import::STATUS_UPLOADED:
                    $redirect = redirect(route('crud.import.processing.games', [
                        'id' => $importItem->id,
                    ]));
                    break;
                case Import::STATUS_GAMES:
                    $redirect = redirect(route('crud.import.processing.teams', [
                        'id' => $importItem->id,
                    ]));
                    break;
                case Import::STATUS_TEAMS:
                    $redirect = redirect(route('crud.import.processing.players', [
                        'id' => $importItem->id,
                    ]));
                    break;
                case Import::STATUS_PLAYERS:
                    $redirect = redirect(route('crud.import.processing.done', [
                        'id' => $importItem->id,
                    ]));
                    break;
                default:
                    $this->_statusUpdate($importItem, Import::STATUS_ERROR);
                    $redirect = redirect(route('crud.import.index'));
                    break;
            }
        }

        return $redirect;
    }

    private function _statusUpdate(Import $importItem, $status)
    {
        $importItem->status = $status;
        $importItem->save();
    }
}
