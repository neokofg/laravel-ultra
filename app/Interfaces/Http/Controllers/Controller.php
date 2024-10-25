<?php

namespace App\Interfaces\Http\Controllers;

use Illuminate\Http\JsonResponse;

readonly abstract class Controller
{
    /**
     * @param $data
     * @param $statusCode
     * @return JsonResponse
     */
    public function present($data, $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
