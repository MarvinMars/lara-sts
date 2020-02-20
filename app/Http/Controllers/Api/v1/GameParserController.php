<?php

namespace App\Http\Controllers\Api\v1;

use App\CustomTypesForParser\XMLcopy;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiXSDValidationRequest;
use App\Models\GameParser;
use App\Rules\XMLApiValidation;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Parser;

class GameParserController extends Controller
{
    protected $counter = 0;

    /**
     * @param ApiXSDValidationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */

    public function index(ApiXSDValidationRequest $request)
    {
        $file = $request->file('xml');
        $post_id = $request->get('post_id') ? $request->get('post_id') : 0;
        $xml = simplexml_load_file($request->file('xml')->getRealPath());
        $file_name = $request->file('xml')->getClientOriginalName();
        $sport = '';

        if ($xml instanceof \SimpleXMLElement) {
            $sport = $xml->getName();
        }

        if ($sport && $file_name) {
            $path = sprintf("%s/%s", $sport, $post_id);
            $path_file = $path . '/' . $file_name;

            $storage = Storage::disk('parser_import')->putFileAs($path, $file, $file_name);

            if ($storage) {
                $data = [
                    'path' => $path_file,
                    'post_id' => $post_id,
                    'user_id' => \Auth::user()->id
                ];

                $game = GameParser::create($data);

                return response()->json(['game' => $game]);
            } else {
                return response()->json(['error' => true], 500);
            }
        }
    }

    public function StoreFile($sport, $post_id, $file)
    {
        $file_name = $file->getBasename();
        $path = sprintf("%s/%s", $sport, $post_id);
        $path_file = $path . '/' . $file_name;

        $storage = Storage::disk('parser_import')->putFileAs($path, $file, $file_name);

        if ($storage) {
            $data = [
                'path' => $path_file,
                'post_id' => $post_id,
                'user_id' => \Auth::user()->id
            ];

            $game = GameParser::create($data);
            return $game;
        } else {
            return false;
        }
    }

    public function getContent($file_url)
    {
        $contents = file_get_contents(str_replace(' ', '%20', $file_url));
        if (!$contents && $this->counter < 3) {
            $this->counter++;
            sleep(30);
            $this->getContent($file_url);
        } else {
            $this->counter = 0;
            return $contents;
        }
    }

    public function indexUpload(Request $request)
    {
        $file_url = $request->get('file_url');
        $post_id = $request->get('post_id') ? $request->get('post_id') : 0;
        $info = pathinfo($file_url);
        if ($file_url) {
            if ($contents = $this->getContent($file_url)) {
                $file = Storage::disk('parser_tmp')->put($info['basename'], $contents);

                if ($file) {
                    $file_d = Storage::disk('parser_tmp')->path($info['basename']);

                    $uploadedFile = new File($file_d);

                    $data = [
                        'xml' => $uploadedFile,
                        'post_id' => $post_id,
                    ];

                    $validator = \Validator::make($data, [
                        'xml' => ['required', 'file', new XMLApiValidation],
                        'post_id' => 'integer|nullable'
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['error' => $validator->errors()->first()], 422);
                    }

                    $xml = simplexml_load_file($uploadedFile->getRealPath());

                    $sport = '';

                    if ($xml instanceof \SimpleXMLElement) {
                        $sport = $xml->getName();
                    }

                    if ($sport && $uploadedFile) {
                        $game = $this->StoreFile($sport, $post_id, $uploadedFile);
                        Storage::disk('parser_tmp')->delete($uploadedFile->getBasename());
                        if ($game) {
                            return response()->json(['game' => $game]);
                        } else {
                            return response()->json(['error' => true], 422);
                        }
                    }
                }
            }
        }
        return response()->json(['error' => true], 422);
    }

    /**
     * @param GameParser $game_parser
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */

    public function show(GameParser $game_parser, Request $request)
    {
        if ($game_parser && Storage::disk('parser_import')->exists($game_parser->path)) {
            $xml = Storage::disk('parser_import')->get($game_parser->path);
            $xml = Parser::parse($xml, new XMLcopy());
            $sport = $xml->keys()->first();
            $tables = $request->get('includes');
            if (empty($xml->first()) || !isset($xml->first()['team'])) {
                return response()->json(['error' => 'File not found'], 404);
            }
            $teams = $this->gameTransformer($xml->first(), $sport, $tables);


            return response()->json($teams);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function gameTransformer($data, $sport, $tables = [])
    {
        $fractal = new Manager();
        $sport_transformer = sprintf("\App\Transformers\%s\index", $sport);
        if ($tables) {
            $fractal->parseIncludes($tables);
        }
        $resource = new Item($data, new $sport_transformer());
        $array = $fractal->createData($resource)->toArray();
        $array['stats'] = [];
        if (!empty($array['data']['base']['data'][0]['stats'])) {
            $array['stats'] = collect($array['data']['base']['data'][0]['stats'])->keys()->toArray();
        }
        $array['sport'] = $sport;
        return $array;
    }
}
