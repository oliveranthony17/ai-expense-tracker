<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Expense;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 1, 9_999_999),
            'title' => $this->faker->words(3, true),
            'date' => $this->faker->date(),
            'description' => $this->faker->optional()->sentence(),
            'category' => $this->faker->randomElement(['Food', 'Rent', 'Travel', 'Entertainment', 'Other']),
        ];
    }
}
