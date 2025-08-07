<?php

namespace App\Services;

interface TicketProviderInterface
{
    public function getShows(): array;

    public function getShowEvents(int $showId): array;

    public function getEventSeats(int $eventId): array;

    public function bookSeats(int $eventId, array $seats, string $buyerName): array;
}
