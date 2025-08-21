<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountShowRequest;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function store(AccountStoreRequest $request)
    {
        $data = $request->validated();

        $account = Account::create([
            'number' => $data['numero_conta'],
            'balance' => $data['saldo'],
        ]);

        return response()->json(
            AccountResource::make($account),
            Response::HTTP_CREATED
        );
    }

    public function show(AccountShowRequest $request)
    {
     
        $data = $request->validated();

        $account = Account::where('number', $data['numero_conta'])->first();

        return response()->json(
            AccountResource::make($account),
            Response::HTTP_OK
        );
    }
}
