<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\vendor_uniqid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'client_contactnum' => 'required|regex:/^\d{10,15}$/',
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

        $client = Client::where('contact', $validatedData['client_contactnum'])
            ->where('is_valid', true)
            ->first();

        $client_id = $client->id;

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
            'booking' => [
                'client_name' => $client->name,
                'booking_date' => $booking->booking_date,
                'shift' => $booking->shift,
                'guest' => $booking->guest,
                'type' => $booking->type,
                'status' => $booking->status,
                'vendor_website' => $booking->vendor()->first()->website
            ],
        ], 201);
    }

    public function manual_booking(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'contact' => 'required|regex:/^\d{10,15}$/',
                'booking_date' => 'required|date|after_or_equal:today',
                'guest' => 'required|integer|min:1',
                'shift' => 'required|in:morning,evening,whole_day',
                'type' => 'required|in:wedding,birthday,corporate_event,other',
            ]);

            $vendor_id = auth('vendor')->id();

            $client = Client::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'contact' => $validatedData['contact'],
                'booking_source' => 'manual',
                'is_valid' => true,
            ]);

            $booking = Booking::create([
                'vendor_id' => $vendor_id,
                'client_id' => $client->id,
                'booking_date' => $validatedData['booking_date'],
                'shift' => $validatedData['shift'],
                'guest' => $validatedData['guest'],
                'type' => $validatedData['type'],
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Booking created successfully.',
                'booking' => [
                    'client_name' => $client->name,
                    'booking_date' => $booking->booking_date,
                    'shift' => $booking->shift,
                    'guest' => $booking->guest,
                    'type' => $booking->type,
                    'status' => $booking->status,
                    'booking_source' => 'manual',
                ],
                'status' => 'success'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Booking creation failed. Please try again.',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }


    public function get_booking_info($booking_id)
    {

        $vendor_id = auth('vendor')->user()->id;

        $booking_detail = Booking::with('client')
            ->where('id', $booking_id)
            ->first();

        if (!$booking_detail) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        if ($vendor_id != $booking_detail->vendor_id) {
            return response()->json(['message' => 'Vendor not found'], 404);
        }

        return response()->json(['booking_detail' => $booking_detail]);
    }

    public function updateStatus(Request $request)
    {
        $booking = Booking::find($request->id);
        if ($booking) {
            $booking->status = $request->status;
            $booking->save();
            return response()->json(['message' => 'Status updated successfully', 'status' => 'success']);
        }
        return response()->json(['message' => 'Booking not found', 'status' => 'error'], 404);
    }

}
