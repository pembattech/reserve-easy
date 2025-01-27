<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function onlinebooking($vendor, Request $request)
    {
        $validatedData = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'shift' => 'required|in:morning,evening,whole_day',
            'guest' => 'required|integer|min:1',
            'type' => 'required|in:wedding,birthday,corporate_event,other',
        ]);

        return view('booking.booking_form', [
            'booking_date' => $validatedData['booking_date'],
            'shift' => $validatedData['shift'],
            'guest' => $validatedData['guest'],
            'type' => $validatedData['type'],
            'vendor' => $vendor,
        ]);
    }

    
}
