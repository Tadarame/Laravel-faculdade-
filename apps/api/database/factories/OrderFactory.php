<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Order> */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $product = Product::factory()->create();
        $quantity = fake()->numberBetween(1, 5);

        return [
            'customer_id' => Customer::factory(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total' => $product->price * $quantity,
            'status' => fake()->randomElement(['pending', 'paid', 'cancelled', 'completed']),
        ];
    }
}
