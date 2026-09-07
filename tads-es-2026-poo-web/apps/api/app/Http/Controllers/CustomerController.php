<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::with('orders')->paginate();
    }

    public function store(CustomerStoreRequest $request): JsonResponse
    {
        $customer = Customer::create($request->validated());

        return response()->json($customer, 201);
    }

    public function show(Customer $customer): Customer
    {
        return $customer->load('orders');
    }

    public function update(CustomerUpdateRequest $request, Customer $customer): Customer
    {
        $customer->update($request->validated());

        return $customer;
    }

    public function destroy(Customer $customer): JsonResponse
    {
        if ($customer->orders()->exists()) {
            return response()->json([
                'message' => 'Cliente possui pedidos relacionados.',
            ], 422);
        }

        $customer->delete();

        return response()->json(null, 204);
    }
}
