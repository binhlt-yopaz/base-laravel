<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponseTrait
{
    protected function responseSuccess($data = null, $code = ''): JsonResponse
    {
        return response()->json(
            [
                'code'  => $code,
                'status' => 'success',
                'data'   => $data,
            ],
            Response::HTTP_OK
        );
    }

    protected function responseError($message = '', $code = ''): JsonResponse
    {
        return response()->json(
            [
                'code'  => $code,
                'status'  => 'error',
                'message' => $message,
            ],
        );
    }
}
