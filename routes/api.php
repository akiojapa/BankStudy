<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::post('/transacao', [TransferController::class, 'store'])
    ->name('transfer.store');

Route::post('/conta', [AccountController::class, 'store'])
    ->name('accounts.store');

Route::get('/conta', [AccountController::class, 'show'])
    ->name('accounts.show');

