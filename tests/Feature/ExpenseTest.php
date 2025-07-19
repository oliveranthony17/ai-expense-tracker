<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use App\Models\Expense;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_a_list_of_expenses(): void
    {
        Expense::factory()->count(5)->create();

        $response = $this->getJson('/api/expenses');

        $response->assertStatus(200)
                 ->assertJsonCount(5);
    }
}
