<?php

namespace App\Http\Requests;

use App\Rules\ExistsAccount;
use Illuminate\Foundation\Http\FormRequest;

class AccountShowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero_conta' => ['required', 'integer', new ExistsAccount],

        ];
    }
}
