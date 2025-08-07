<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LeadbookProvider implements TicketProviderInterface
{
    private string $baseUrl = 'https://leadbook.ru/test-task-api';
    private string $token = 'pmN3TQFQalcOhCwZc18KcPMWZyG2EQHz8al9sCYw';

    public function getShows(): array
    {
        $response = Http::withHeaders($this->getHeaders())
                        ->get("{$this->baseUrl}/shows");

        return $response->json() ?? [];
    }

    public function getShowEvents(int $showId): array
    {
        $response = Http::withHeaders($this->getHeaders())
                        ->get("{$this->baseUrl}/shows/{$showId}/events");

        return $response->json() ?? [];
    }

    public function getEventSeats(int $eventId): array
    {
        $response = Http::withHeaders($this->getHeaders())
                        ->get("{$this->baseUrl}/events/{$eventId}/places");

        return $response->json() ?? [];
    }

    public function bookSeats(int $eventId, array $seats, string $buyerName): array
    {
        $payload = [
            'places' => $seats,
            'name' => $buyerName,
        ];

        $response = Http::withHeaders($this->getHeaders())
                        ->post("{$this->baseUrl}/events/{$eventId}/reserve", $payload);

        return $response->json() ?? [];
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ];
    }
}
