<?php

namespace App\Http\Controllers;

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
}
