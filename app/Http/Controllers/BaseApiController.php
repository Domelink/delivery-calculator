<?php

namespace App\Http\Controllers;

use Throwable;
use App\Exceptions\BaseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BaseApiController
{
    public function response(
        string $message = 'Success!',
        mixed $data = [],
        array|string $errors = [],
        int $status = 200
    ): JsonResponse {
        return response()->json(compact('message', 'data', 'errors', 'status'), $status);
    }

    /**
     * Handle entries exception, with logging it and giving answer
     *
     * @param Throwable $exception any throwable exceptions to the response
     * @param int $statusCode status code of answer, 500 by default. Uses only when $exception is not inheritor of BaseException
     * @return JsonResponse
     */
    public function handleException(Throwable $exception, int $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        Log::error($exception->getMessage(), ['trace' => $exception->getTrace()]);

        return $this->response(
            __('messages.error'),
            [],
            $exception instanceof BaseException ? $exception->getMessage() : __('messages.something_went_wrong'),
            $exception instanceof BaseException ? $exception->getCode() : $statusCode
        );
    }
}
