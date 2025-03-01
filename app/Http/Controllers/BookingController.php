<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a list of all bookings.
     */
    public function index()
    {
        return response()->json(Booking::paginate(10));
    }

    /**
     * Store a newly created booking in the database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'phone'               => 'required|string|max:20',
            'booking_date'        => 'required|date',
            'booking_time'        => 'required',
            'pickup_date'         => 'required|date',
            'pickup_time'         => 'required',
            'pickup_location'     => 'required|string|max:255',
            'dropoff_location'    => 'required|string|max:255',
            'number_of_passengers'=> 'nullable|string',
            'vehicle_type'        => 'nullable|string|max:255',
            'booking_status'      => 'nullable|string|max:50',
            'remarks'             => 'nullable|string',
        ]);

        $booking = Booking::create($validatedData);

        return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 201);
    }


    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validatedData = $request->validate([
            'name'                => 'sometimes|string|max:255',
            'email'               => 'sometimes|email|max:255',
            'phone'               => 'sometimes|string|max:20',
            'booking_date'        => 'sometimes|date',
            'booking_time'        => 'sometimes',
            'pickup_date'         => 'sometimes|date',
            'pickup_time'         => 'sometimes',
            'pickup_location'     => 'sometimes|string|max:255',
            'dropoff_location'    => 'sometimes|string|max:255',
            'number_of_passengers'=> 'nullable|string',
            'vehicle_type'        => 'nullable|string|max:255',
            'booking_status'      => 'nullable|string|max:50',
            'remarks'             => 'nullable|string',
        ]);

        $booking->update($validatedData);

        return response()->json(['message' => 'Booking updated successfully', 'data' => $booking]);
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
