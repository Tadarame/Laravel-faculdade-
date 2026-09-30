<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
        ]);

        $customer = Customer::create($validated);

        return response()->json($customer, Response::HTTP_CREATED);
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:customers,email,'.$customer->id],
        ]);

        $customer->update($validated);

        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
