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

        // Check if client already exists
        $existingClient = Client::where('contact', $request->contact)->first();
        if ($existingClient) {

            // Check if OTP was recently sent
            if ($existingClient->created_at >= now()->subMinutes(5) && $existingClient->is_valid == false && $existingClient->booking_source == 'online') {
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP already sent. Please wait before requesting again.'
                ]);
            }

        } else {
            $otp = $this->generateAlphanumericOTP(5);

            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'booking_source' => 'online',
                'OPT' => $otp,
                'is_valid' => false,
            ]);

            return response()->json(['otp' => $otp, 'message' => 'OTP sent successfully.', 'status' => 'success']);
        }
    }

    public function validateOtp(Request $request)
    {
        $validate_data = $request->validate([
            'otp' => 'required|regex:/^[A-Za-z0-9]{5}$/',
            'contact' => 'required|string|max:15',
        ]);

        $client = Client::where('contact', $validate_data['contact'])->first();

        if ($client) {
            // Check if OTP has already been used (is_valid is true)
            if ($client->is_valid) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has already been used. Please request a new one if needed.'
                ]);
            }

            if ($client->OPT === $validate_data['otp']) {
                $client->update(['is_valid' => true]);

                return response()->json([
                    'success' => true,
                    'message' => 'OTP validated successfully!'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP. Please try again.'
        ]);
    }

    function generateAlphanumericOTP($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
    }

}
