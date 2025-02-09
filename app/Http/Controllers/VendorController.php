<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        // TODO: MAKE IT ONLY FOR SUPER ADMIN
        $vendors = Vendor::query()->get();
        return view('vendor.index', compact('vendors'));
    }


    public function show()
    {
        $vendor = auth('vendor')->user()->load('bookings');
        $recentBookings = $vendor->bookings()->latest()->take(4)->get();

        return view('vendor.show', compact('vendor', 'recentBookings'));

    }

    public function update(Request $request, Vendor $vendor)
    {

        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'business_type' => 'required|string|in:Event Venue,Party Planner,Catering Service',
            'description' => 'nullable|string',
            // 'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'website' => 'nullable|url',
        ]);

        // dd($validate_data);

        // Update vendor data
        $vendor->update([
            'name' => $validate_data['name'],
            'email' => $validate_data['email'],
            'phone' => $validate_data['phone'],
            'business_type' => $validate_data['business_type'],
            'description' => $validate_data['description'],
            // 'logo' => $validate_data['logo'],
            // 'website' => $validate_data['website'],
        ]);

        // // Optionally handle file upload
        // if ($request->hasFile('logo')) {
        //     $logoPath = $request->file('logo')->store('logos', 'public');
        //     $vendor->update(['logo' => $logoPath]);
        // }

        // Redirect back with a success message
        return redirect()->route('vendor.vendor_profile', $vendor)->with('success', 'Profile updated successfully!');

    }

    public function booking_management()
    {
        $vendor = auth('vendor')->user()->load('bookings.client');

        return view('booking.booking_mgmt', compact('vendor'));
    }
    public function vendor_profile()
    {
        $vendor = auth('vendor')->user();

        return view('vendor.vendor_profile', compact('vendor'));
    }
    public function vendor_setting()
    {
        return view('vendor.vendor_setting');
    }

}
