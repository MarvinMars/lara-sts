<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\Controller;
use App\Repositories\SportRepository;
use App\Transformers\SportTransformer;
use Illuminate\Http\Request;

/**
 * Class SportsController
 * @package App\Http\Controllers\Api\v1
 */
class SportsController extends Controller
{
    protected $sportRepository;

    public function __construct(SportRepository $sportRepository)
    {
        parent::__construct();

        $this->sportRepository = $sportRepository;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->respondWithCollection(
            $this->sportRepository->findAllByField('title',
                $request->input('q', null), 10,
                'asc', 'title'),
            new SportTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->respondWithItem($this->sportRepository->getById($id), new SportTransformer());
    }
}
