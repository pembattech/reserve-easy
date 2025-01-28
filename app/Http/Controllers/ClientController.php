<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{

    public function client()
    {
        // Return a view with the OTP (you can pass it to the client-side as well)
        return view('booking.client_store');
    }

    public function client_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:15',
        ]);

        $otp = random_int(10000, 99999);

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'OPT' => $otp,
        ]);

        return response()->json(['otp' => $otp, 'request' => $request->all()]);
    }

    public function validateOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:5',
            'contact' => 'required|string|max:15',
        ]);

        $client = Client::where('contact', $request->contact)->first();

        if ($client && $client->OPT == $request->otp) {
            $client->update(['is_valid' => true]);

            return response()->json(['success' => true, 'message' => 'OTP validated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP. Please try again.']);
        }
    }
}
