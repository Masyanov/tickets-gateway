<?php

use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('shows', [TicketController::class, 'shows']);
Route::get('shows/{showId}/events', [TicketController::class, 'showEvents']);
Route::get('events/{eventId}/places', [TicketController::class, 'eventSeats']);
Route::post('events/{eventId}/reserve', [TicketController::class, 'bookSeats']);

