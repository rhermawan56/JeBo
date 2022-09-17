<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 2),
            'product_id' => fake()->numberBetween(1, 6),
            'order_by'=> fake()->name(),
            'qty' => fake()->numberBetween(1, 3),
            'status' => 'waiting'
        ];
    }
}
