<?php

namespace App\Exceptions;
use Illuminate\Http\JsonResponse;


use Exception;
use Illuminate\Http\Response;

class InsufficientBalanceException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(
            ['message' => __('validation.insufficient_funds')],
            Response::HTTP_NOT_FOUND
        );
    }
}