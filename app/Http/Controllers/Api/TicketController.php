<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TicketProviderInterface;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="Tickets Gateway API", version="1.0")
 */
class TicketController extends Controller
{
    private TicketProviderInterface $provider;

    public function __construct(TicketProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @OA\Get(
     *     path="/api/shows",
     *     summary="Get list of shows",
     *     @OA\Response(response="200", description="List of shows")
     * )
     */
    public function shows()
    {
        $shows = $this->provider->getShows();
        return response()->json($shows);
    }

    /**
     * @OA\Get(
     *     path="/api/shows/{showId}/events",
     *     summary="Get events list for a show",
     *     @OA\Parameter(
     *         name="showId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="List of events")
     * )
     */
    public function showEvents($showId)
    {
        $events = $this->provider->getShowEvents((int)$showId);
        return response()->json($events);
    }

    /**
     * @OA\Get(
     *     path="/api/events/{eventId}/places",
     *     summary="Get places for event",
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="places data")
     * )
     */
    public function eventSeats($eventId)
    {
        $seats = $this->provider->getEventSeats((int)$eventId);
        return response()->json($seats);
    }

    /**
     * @OA\Post(
     *     path="/api/events/{eventId}/reserve",
     *     summary="reserve places for event",
     *     @OA\Parameter(
     *         name="eventId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "places"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="places", type="array", @OA\Items(type="integer"))
     *         )
     *     ),
     *     @OA\Response(response="200", description="reservation result")
     * )
     */
    public function bookSeats(Request $request, $eventId)
    {
        $data = $request->validate([
            'places' => 'required|array|min:1',
            'name' => 'required|string|min:2',
        ]);

        $bookingResult = $this->provider->bookSeats($eventId, $data['places'], $data['name']);
        return response()->json($bookingResult);
    }
}
