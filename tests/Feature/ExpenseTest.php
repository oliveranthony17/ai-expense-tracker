<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use App\Models\Expense;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    private string $apiKey;

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiKey = config('app.api_key');
    }

    #[Test]
    public function it_returns_a_list_of_expenses(): void
    {
        $expenses = Expense::factory()->count(5)->create();

        $response = $this->getJson('/api/expenses', [
            'X-API-Key' => $this->apiKey,
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJsonPath('0.id', $expenses->sortByDesc('date')->first()->id);
    }

    #[Test]
    public function it_rejects_list_without_api_key(): void
    {
        $response = $this->getJson('/api/expenses');

        $response->assertStatus(401);
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

        $response = $this->postJson('/api/expenses', $payload, [
            'X-API-Key' => $this->apiKey,
        ]);

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

    #[Test]
    public function it_rejects_creation_without_api_key(): void
    {
        $payload = [
            'amount' => 42.50,
            'title' => 'Lunch at Cafe',
            'date' => '2025-07-19',
            'description' => 'Quick sandwich and drink',
            'category' => 'Food',
        ];

        $response = $this->postJson('/api/expenses', $payload);

        $response->assertStatus(401);
    }
}
