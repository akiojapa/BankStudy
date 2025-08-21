<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = [
        'number',
        'balance',
    ];

    public function getFormattedBalanceAttribute()
    {
        return number_format($this->balance, 2, ',', '.');
    }

    public function Transfers()
    {
        return $this->hasMany(Transfer::class);
    }

}
