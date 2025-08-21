<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethodEnum;
use App\Exceptions\InsufficientBalanceException;
use App\Http\Requests\TransferStoreRequest;
use App\Http\Resources\TransferResource;
use App\Models\Account;
use App\Models\Transfer;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Response;

class TransferController extends Controller
{
    public function store(TransferStoreRequest $request)
    {
        $data = $request->validated();

        $account = Account::where('number', $data['numero_conta'])->first();

        $valueWithFee = $data['valor'] * PaymentMethodEnum::getFeeByValue($data['forma_pagamento']);

        if ($account->balance < $valueWithFee) {
            throw new InsufficientBalanceException();
        }

        $account->decrement('balance', $valueWithFee);


        $transfer = Transfer::create([
            'account_id' => $account->id,
            'value' => $data['valor'],
            'payment_method' => $data['forma_pagamento'],
        ]);

        $transfer->load('account');

        return response()->json(
            TransferResource::make($transfer),
            Response::HTTP_CREATED
        );

    }
}
