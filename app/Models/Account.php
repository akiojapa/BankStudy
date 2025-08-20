<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = [
        'number',
        'balance',
    ];

    public function getFormattedBalanceAttribute()
    {
        return number_format($this->balance, 2, ',', '.');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
