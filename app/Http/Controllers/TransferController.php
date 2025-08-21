<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferStoreRequest;
use App\Http\Resources\TransferResource;
use Domain\Transfer\TransferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TransferController extends Controller
{
    public function __construct(
        protected TransferService $service
    ) {
    }

    public function store(TransferStoreRequest $request): JsonResponse
    {
        return response()->json(
            TransferResource::make($this->service->transfer($request->validated())),
            Response::HTTP_CREATED
        );

    }
}
