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

        Session::put('generated_otp', $otp);

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'OPT' => $otp,
        ]);

        // Send the OTP as JSON response
        return response()->json(['otp' => $otp]);
    }

    public function validateOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:5', // Ensure OTP is a 5-digit number
            'contact' => 'required|string|max:15',
        ]);

        // Retrieve the client record based on the email (or contact, whichever is available)
        $client = Client::where('contact', $request->contact)->first();

        // Check if the client exists and the OTP matches
        if ($client && $client->OPT == $request->otp) {
            
            $client->update(['is_valid' => true]);

            
            return response()->json(['success' => true, 'message' => 'OTP validated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP. Please try again.']);
        }
    }

}
