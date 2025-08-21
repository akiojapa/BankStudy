<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $table = 'transfers';

    protected $fillable = [
        'value',
        'payment_method',
        'account_id',
    ];

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
