<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// I actually import the MODEL here not the factory - the `HasFactory` trait on the model wires up the factory
// use Database\Factories\ExpenseFactory; - NOT THIS
use App\Models\Expense;


class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::factory()->count(50)->create();
    }
}
