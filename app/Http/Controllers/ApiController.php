<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    /**
     * @var int
     */
    protected int $statusCode = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param  mixed  $statusCode
     * @return ApiController
     */
    public function setStatusCode(mixed $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param  string  $message
     * @return JsonResponse
     */
    public function respondNotFound(string $message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param  string  $message
     * @return JsonResponse
     */
    public function respondInternalError(string $message = 'Internal Error!')
    {
        return $this->setStatusCode(505)->respondWithError($message);
    }

    /**
     * @param $data
     * @param  array  $headers
     * @return JsonResponse
     */
    public function respond($data, array $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}
