<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'total' => ['required', 'numeric'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $order = Order::create($validated);

        return response()->json($order, Response::HTTP_CREATED);
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'total' => ['sometimes', 'numeric'],
            'status' => ['sometimes', 'string', 'max:255'],
        ]);

        $order->update($validated);

        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
