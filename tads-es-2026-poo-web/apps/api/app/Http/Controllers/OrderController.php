<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['customer', 'product'])->paginate();
    }

    public function store(OrderStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $product = Product::findOrFail($data['product_id']);

        $data['total'] = $product->price * $data['quantity'];
        $data['status'] ??= 'pending';

        $order = Order::create($data);

        return response()->json($order->load(['customer', 'product']), 201);
    }

    public function show(Order $order): Order
    {
        return $order->load(['customer', 'product']);
    }

    public function update(OrderUpdateRequest $request, Order $order): Order
    {
        $data = $request->validated();
        $order->fill($data);

        $product = array_key_exists('product_id', $data)
            ? Product::findOrFail($data['product_id'])
            : $order->product;

        $quantity = $data['quantity'] ?? $order->quantity;
        $order->total = $product->price * $quantity;
        $order->save();

        return $order->load(['customer', 'product']);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(null, 204);
    }
}
