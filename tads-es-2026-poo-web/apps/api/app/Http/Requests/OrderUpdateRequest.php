<?php

namespace App\Http\Requests;

class OrderUpdateRequest extends OrderStoreRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'quantity' => ['sometimes', 'integer', 'min:1'],
            'status' => ['sometimes', 'string', 'in:pending,paid,cancelled,completed'],
        ];
    }
}
