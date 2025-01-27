<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\vendor_uniqid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('vendor.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|string|confirmed|min:8',
            'location' => 'required|string|max:255',
        ]);

        $create_vendor = Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location' => $request->location,

        ]);

        if ($create_vendor) {
            $vendorName = strtolower(str_replace(' ', '', $request->name));

            $uniqueId = $vendorName;
            $counter = 1;

            while (vendor_uniqid::where('unique_id', $uniqueId)->exists()) {
                $uniqueId = $vendorName . $counter;
                $counter++;
            }

            vendor_uniqid::create([
                'vendor_id' => $create_vendor->id,
                'unique_id' => $uniqueId,
            ]);

            return redirect()->route('vendor.login')->with('success', 'Registration successful! Please login.');
        }
    }

    public function showLoginForm()
    {
        return view('vendor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('vendor')->attempt($request->only('email', 'password'))) {
            return redirect()->route('vendor.index'); // Create a dashboard route later
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
}
