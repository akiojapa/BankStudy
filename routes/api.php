<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;

Route::post('/transfer', [TransferController::class, 'store'])
    ->name('transfer.store');

Route::post('/account', [AccountController::class, 'store'])
    ->name('accounts.store');

Route::get('/conta', [AccountController::class, 'show'])
    ->name('accounts.show');

