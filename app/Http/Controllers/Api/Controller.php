<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller as BaseController;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class Controller extends BaseController
{
    use AuthorizesRequests;
    /**
     * @var int $statusCode
     */
    protected $statusCode = 200;

    const CODE_WRONG_ARGS = 'WRONGARGS';
    const CODE_NOT_FOUND = 'NOTFOUND';
    const CODE_INTERNAL_ERROR = 'INTERNALERROR';
    const CODE_UNAUTHORIZED = 'UNAUTHORIZED';
    const CODE_FORBIDDEN = 'FORBIDDEN';
    const CODE_INVALID_MIME_TYPE = 'INVALID_MIME_TYPE';

    /**
     * @var Manager $fractal
     */
    protected $fractal;

    public function __construct()
    {
        $this->fractal = new Manager;

        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

    /**
     * Get the status code.
     *
     * @return int $statusCode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the status code.
     *
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Repond a no content response.
     *
     */
    public function noContent()
    {
        return response()->json([], 204);
    }

    /**
     * Respond the item data.
     *
     * @param $item
     * @param $callback
     * @return mixed
     */
    public function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * Respond the collection data.
     *
     * @param $collection
     * @param $callback
     * @return mixed
     */
    public function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     *  Respond the collection data with pagination.
     *
     * @param $paginator
     * @param $callback
     * @return mixed
     */
    public function respondWithPaginator($paginator, $callback)
    {
        $resource = new Collection($paginator->getCollection(), $callback);

        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * Respond the data.
     *
     * @param array $array
     * @param array $headers
     * @return mixed
     */
    public function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, $this->statusCode, $headers, JSON_NUMERIC_CHECK);
    }

    /**
     * Respond the error message.
     *
     * @param  string $message
     * @param  string $errorCode
     *
     * @return mixed
     */
    protected function respondWithError($message, $errorCode)
    {
        return $this->respondWithArray([
            'error' => [
                'code'      => $errorCode,
                'http_code' => $this->statusCode,
                'message'   => $message,
            ],
        ]);
    }

    /**
     * Respond the error of 'Forbidden'
     *
     * @param  string $message
     *
     * @return mixed
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Respond the error of 'Internal Error'.
     *
     * @param  string $message
     *
     * @return mixed
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Respond the error of 'Resource Not Found'
     *
     * @param  string $message
     *
     * @return mixed
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Respond the error of 'Unauthorized'.
     *
     * @param  string $message
     *
     * @return mixed
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
            ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Respond the error of 'Wrong Arguments'.
     *
     * @param  string $message
     *
     * @return mixed
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
            ->respondWithError($message, self::CODE_WRONG_ARGS);
    }
}
