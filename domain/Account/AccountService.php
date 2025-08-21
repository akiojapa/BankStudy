<?php

namespace Domain\Account;

use App\Models\Account;

class AccountService
{
    public function storeAccount(array $data)
    {
        return Account::create([
            'number' => $data['numero_conta'],
            'balance' => $data['saldo'],
        ]);
    }

    public function findAccountByNumber(int $number): ?Account
    {
        return Account::where('number', $number)->first();
    }
}