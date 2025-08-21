<?php

namespace Domain\Transfer;

use App\Enums\PaymentMethodEnum;
use App\Exceptions\InsufficientBalanceException;
use App\Models\Account;
use App\Models\Transfer;

class TransferService
{
    public function transfer(array $data): Transfer
    {

        $account = Account::where('number', $data['numero_conta'])->first();

        $this->applyFee($data, $account);

        return Transfer::create([
            'account_id' => $account->id,
            'value' => $data['valor'],
            'payment_method' => $data['forma_pagamento'],
        ])->load('account');
    }

    private function applyFee(array $data, Account $account): void
    {
        $valueWithFee = $data['valor'] * PaymentMethodEnum::getFeeByValue($data['forma_pagamento']);

        if ($account->balance < $valueWithFee) {
            throw new InsufficientBalanceException();
        }

        $account->decrement('balance', $valueWithFee);
    }
}
