<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class TicketControllerTest extends TestCase
{
    public function testShowsReturnsData()
    {
        // Mocked response from external API
        $mockResponse = [
            ['id' => 1, 'title' => 'Test Show 1'],
            ['id' => 2, 'title' => 'Test Show 2'],
        ];

        Http::fake([
            'leadbook.ru/*' => Http::response($mockResponse, 200),
        ]);

        $response = $this->getJson('/api/shows');

        $response->assertStatus(200)
                 ->assertJson($mockResponse);
    }
}
