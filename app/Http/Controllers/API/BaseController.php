<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * @param $result
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, string $message, int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, $errorMessages = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
