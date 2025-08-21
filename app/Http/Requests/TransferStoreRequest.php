<?php

namespace App\Http\Requests;

use App\Rules\ExistsAccount;
use Illuminate\Foundation\Http\FormRequest;

class TransferStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'forma_pagamento' => ['required', 'string', 'in:P,D,C'],
            'numero_conta' => ['required', 'integer', new ExistsAccount],
            'valor' => ['required', 'numeric', 'min:0', 'gte:0']
        ];
    }
}
