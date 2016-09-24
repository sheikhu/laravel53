<?php
/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 02/05/16
 * Time: 22:22
 */

namespace App\Http\Controllers\Api;


use League\Fractal;
use \App\Http\Controllers\Controller;
use \Symfony\Component\HttpFoundation\Response as ApiResponse;
use \Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    protected $statusCode = ApiResponse::HTTP_OK;

    protected $fractal;


    public function __construct()
    {
        $this->fractal = new Fractal\Manager();

        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

    protected function respondWithSuccess($data)
    {
        return $this->respond($data);
    }

    protected function respondNotFound($message = 'Not found')
    {
        return $this->setStatusCode(ApiResponse::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    protected function respondInternalError($message = 'Internal Error Server')
    {
        return $this->setStatusCode(ApiResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    protected function respondUnauthorized($message)
    {
        return $this->setStatusCode(ApiResponse::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }

    private function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ]);
    }

    private function respond($data, $headers=[])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Fractal\Resource\Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithItem($item, $callback)
    {
        $resource = new Fractal\Resource\Item($item, $callback);
        $rootScope = $this->fractal->createData($resource);
        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        return Response::json($array, $this->statusCode, $headers);
    }
}