<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    const SUCCESS_MESSAGE = "Success";
    const NOT_FOUND_MESSAGE = "Not Found";

    public function respondWithSuccess($data = [], $message = self::SUCCESS_MESSAGE)
    {
        return response()->json([
            'success' => true,
            'code' => JsonResponse::HTTP_OK,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondWithNotFound($data = [], $message = self::NOT_FOUND_MESSAGE)
    {
        return response()->json([
            'success' => false,
            'code' => JsonResponse::HTTP_NOT_FOUND,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondWithNotError($data = [], $message = self::NOT_FOUND_MESSAGE)
    {
        return response()->json([
            'success' => false,
            'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => $data
        ]);
    }
}
