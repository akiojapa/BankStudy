<?php

use App\Enums\PaymentMethodEnum;
use App\Models\Account;

test('create a transfer successfully', function () {
    $value = 10.00;

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 10000.00,
    ]);

    $response = $this->post(route('transfer.store'), [
        'forma_pagamento' => 'P',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => $account->balance - $value,
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_method' => 'P',
        'account_id' => $account->id,
        'value' => $value
    ]);
});

test('create a pix transfer with fee', function() {

    $value = 10.00;

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 10000.00,
    ]);

    $response = $this->post(route('transfer.store'), [
        'forma_pagamento' => 'P',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => $account->balance - $value,
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_method' => 'P',
        'account_id' => $account->id,
        'value' => $value
    ]);

});

test('create a credit transfer with fee', function() {

    $value = 10.00;

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 10000.00,
    ]);

    $response = $this->post(route('transfer.store'), [
        'forma_pagamento' => 'C',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => $account->balance - ($value * PaymentMethodEnum::getFeeByValue('C')),
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_method' => 'C',
        'account_id' => $account->id,
        'value' => $value
    ]);
});

test('create a debit transfer with fee', function() {

    $value = 10.00;

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 10000.00,
    ]);

    $response = $this->post(route('transfer.store'), [
        'forma_pagamento' => 'D',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => $account->balance - ($value * PaymentMethodEnum::getFeeByValue('D')),
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_method' => 'D',
        'account_id' => $account->id,
        'value' => $value
    ]);
});


test('not allow to create a transfer with insufficient balance', function () {
    $value = 100.00;

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 50.00,
    ]);

    $response = $this->post(route('transfer.store'), [
        'forma_pagamento' => 'P',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertNotFound();

    $this->assertDatabaseCount('transfers', 0);

});