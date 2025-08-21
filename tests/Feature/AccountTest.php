<?php

use App\Models\Account;

test('create an account', function () {
    $response = $this->post(
        route('accounts.store'),
        [
            'numero_conta' => 234,
            'saldo' => 180.37
        ],
        [
            'Accept' => 'application/json',
        ]
    );

    $response->assertCreated()->assertJson([
        'numero_conta' => 234,
        'saldo' => 180.37,
    ]);
});

test('get info by account number', function () {

    $account = Account::factory()->create();

    $response = $this->get(
        route('accounts.show', ['numero_conta' => $account->number]),
        [
            'Accept' => 'application/json',
        ]
    );

    $response->assertOk()->assertJson([
        'numero_conta' => $account->number,
        'saldo' => $account->balance,
    ]);
});

test('not allow to create an account if already exists', function () {

    $account = Account::factory()->create([
        'number' => 234
    ]);

    $response = $this->post(route('accounts.store'), [
        'numero_conta' => $account->number,
        'saldo' => 180.37,
    ],
    [
        'Accept' => 'application/json',
    ]);

    $response->assertUnprocessable();

    $this->assertDatabaseCount('accounts', 1);
});

test('account not exists', function () {
    $response = $this->get('/conta?numero_conta=999');

    $response->assertNotFound();
});