<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::get();

        if ($reservations->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => __('No reservation found')
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $reservations
        ], 200);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => __('Reservation not found')
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $reservation
        ], 200);
    }

    public function reserve(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'book_id' => 'required|integer',
            'reservation_start_date' => 'required|date',
            'reservation_end_date' => 'date',
        ]);

        $reservation = Reservation::create($data);
        $created = $reservation->save();
        LOG::info($reservation);
        if (!$created) {
            return response()->json([
                'success' => false,
                'message' => __('Reservation not created')
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $reservation
        ], 201);
    }
}
