<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountShowRequest;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Domain\Account\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $service
    ) {
    }

    public function store(AccountStoreRequest $request): JsonResponse
    {
        return response()->json(
            AccountResource::make($this->service->storeAccount($request->validated())),
            Response::HTTP_CREATED
        );
    }

    public function show(AccountShowRequest $request): JsonResponse
    {
        return response()->json(
            AccountResource::make($this->service->findAccountByNumber($request->validated()['numero_conta'])),
            Response::HTTP_OK
        );
    }
}
