<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\vendor_uniqid;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function onlinebooking(Request $request)
    {
        $validatedData = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'shift' => 'required|in:morning,evening,whole_day',
            'guest' => 'required|integer|min:1',
            'type' => 'required|in:wedding,birthday,corporate_event,other',
            'n' => 'required|string'
        ]);

        $vendorUniqId = vendor_uniqid::where('unique_id', $validatedData['n'])->first();

        if (!$vendorUniqId) {
            abort(404, 'Vendor not found.');
        }

        $vendor = $vendorUniqId->vendor;

        return view('booking.booking_form', [
            'booking_date' => $validatedData['booking_date'],
            'shift' => $validatedData['shift'],
            'guest' => $validatedData['guest'],
            'type' => $validatedData['type'],
            'vendor' => $vendor
        ]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'n' => 'required|string',
            'client_contactnum' => 'required|regex:/^\d{10,15}$/', // Accepts 10 to 15 digits
            'booking_date' => 'required|date|after_or_equal:today',
            'guest' => 'required|integer|min:1',
            'shift' => 'required|in:morning,evening,whole_day',
            'type' => 'required|in:wedding,birthday,corporate_event,other',
        ]);


        $vendorUniqId = vendor_uniqid::where('unique_id', $validatedData['n'])->first();

        if (!$vendorUniqId) {
            abort(404, 'Vendor not found.');
        }

        $vendor_id = $vendorUniqId->vendor->id;

        $client_id = Client::where('contact', $validatedData['client_contactnum'])
            ->where('is_valid', true)
            ->first()->id;

        if (!$client_id) {
            return response()->json(['error' => 'Client not found.'], 404);
        }

        $booking = Booking::create([
            'vendor_id' => $vendor_id,
            'client_id' => $client_id,
            'booking_date' => $validatedData['booking_date'],
            'shift' => $validatedData['shift'],
            'guest' => $validatedData['guest'],
            'type' => $validatedData['type'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Booking created successfully.',
            'booking' => $booking,
        ], 201);
    }
}
