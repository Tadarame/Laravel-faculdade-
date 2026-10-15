<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends CustomerStoreRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($this->route('customer'))],
            'phone' => ['sometimes', 'nullable', 'string', 'max:30'],
        ];
    }
}
