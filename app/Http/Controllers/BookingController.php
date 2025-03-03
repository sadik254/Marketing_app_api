<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Company;
use App\Mail\BookingTemplateOne;
use App\Mail\BookingTemplateTwo;
Use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
            'template'            => 'required|in:1,2',
        ]);

        $booking = Booking::create($validatedData);

        // Choose email template based on request
        if ($request->template == '1') {
            Mail::to($booking->email)->send(new BookingTemplateOne($booking));
        } else {
            Mail::to($booking->email)->send(new BookingTemplateTwo($booking));
        }

        return response()->json([
            'message' => 'Booking created successfully', 
            'data' => $booking
        ], 201);
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

    // Universal filter
    public function filter(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->query('search');

        // Validate that a search query is provided
        if (!$search) {
            return response()->json(['message' => 'Please provide a search query'], 400);
        }

        // Start building the query
        $query = Booking::query();

        // Define the fields you want to search
        $searchableFields = [
            'id', 'name', 'email', 'phone', 'booking_date', 'booking_time',
            'pickup_date', 'pickup_time', 'pickup_location', 'dropoff_location',
            'number_of_passengers', 'vehicle_type', 'booking_status', 'remarks'
        ];

        // Apply the search logic with a case-insensitive search for MySQL
        $query->where(function ($q) use ($searchableFields, $search) {
            foreach ($searchableFields as $field) {
                $q->orWhere(DB::raw("LOWER({$field})"), 'LIKE', "%" . strtolower($search) . "%");
            }
        });

        // Paginate the results
        $bookings = $query->paginate(10);

        // Return the paginated results as JSON
        return response()->json($bookings);
    }
}
