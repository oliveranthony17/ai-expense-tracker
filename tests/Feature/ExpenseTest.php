<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use App\Models\Expense;
use function PHPUnit\Framework\assertJson;

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

    #[Test]
    public function it_creates_an_expense(): void
    {
        $payload = [
            'amount' => 42.50,
            'title' => 'Lunch at Cafe',
            'date' => '2025-07-19',
            'description' => 'Quick sandwich and drink',
            'category' => 'Food',
        ];

        $response = $this->postJson('/api/expenses', $payload);

        $response->assertStatus(201)
            ->
            assertJsonFragment([
                'amount' => 42.50,
                'title' => 'Lunch at Cafe',
                'date' => '2025-07-19T00:00:00.000000Z',
                'description' => 'Quick sandwich and drink',
                'category' => 'Food'
            ]);

        $this->assertDatabaseHas('expenses', [
            'amount' => 42.50,
            'title' => 'Lunch at Cafe',
            'date' => '2025-07-19 00:00:00',
            'description' => 'Quick sandwich and drink',
            'category' => 'Food'
        ]);
    }
}
