<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\Controller;
use App\Repositories\GameRepository;
use App\Transformers\GameTransformer;
use Illuminate\Http\Request;

/**
 * Class GamesController
 * @package App\Http\Controllers\Api\v1
 */
class GamesController extends Controller
{
    protected $repository;

    public function __construct(GameRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->respondWithCollection(
            $this->repository->findAllByField('title',
                $request->input('q', null), 10,
                'asc', 'title'),
            new GameTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->respondWithItem($this->repository->getById($id), new GameTransformer());
    }
}
