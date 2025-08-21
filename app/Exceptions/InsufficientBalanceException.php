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
            ['message' => 'The account does not exist.'],
            Response::HTTP_NOT_FOUND
        );
    }
}