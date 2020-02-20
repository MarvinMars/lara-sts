<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\Controller;
use App\Models\Player;
use App\Repositories\SeasonRepository;
use App\Transformers\SeasonTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class SeasonsController
 * @package App\Http\Controllers\Api\v1
 */
class RosterController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = $request->get('term');
        $page = $request->get('page');
        $resultCount = 25;

        $offset = ($page - 1) * $resultCount;

        $players = Player::where('name','like','%' . $query . '%')
            ->with(['seasons:title', 'sport'])
            ->orderBy('name')
            ->skip($offset)
            ->take($resultCount)
            ->get();
        $count = Count(Player::where('name', 'LIKE',  '%' . $query . '%')
            ->orderBy('name')
            ->get(['id',DB::raw('name as text')]));
        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $results = array(
            "results" => $players,
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }
}
