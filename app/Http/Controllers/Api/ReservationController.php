<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        $reservation = Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dibuat! Kami akan menghubungi Anda segera.',
            'data' => $reservation,
        ], 201);
    }

    /**
     * Check availability for a specific date and time.
     */
    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
        ]);

        $existingReservations = Reservation::where('reservation_date', $validated['reservation_date'])
            ->where('reservation_time', $validated['reservation_time'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        $maxCapacity = 10; // Max reservations per time slot
        $available = $existingReservations < $maxCapacity;

        return response()->json([
            'success' => true,
            'available' => $available,
            'remaining_slots' => max(0, $maxCapacity - $existingReservations),
        ]);
    }
}
