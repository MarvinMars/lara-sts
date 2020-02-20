<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\Controller;
use App\Repositories\SeasonRepository;
use App\Transformers\SeasonTransformer;
use Illuminate\Http\Request;


/**
 * Class SeasonsController
 * @package App\Http\Controllers\Api\v1
 */
class SeasonsController extends Controller
{
    protected $seasonRepository;

    public function __construct(SeasonRepository $seasonRepository)
    {
        parent::__construct();

        $this->seasonRepository = $seasonRepository;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->respondWithCollection(
            $this->seasonRepository->findAllByField('title',
                $request->input('q', null), 10,
                'asc', 'title'),
            new SeasonTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->respondWithItem($this->seasonRepository->getById($id), new SeasonTransformer());
    }
}
