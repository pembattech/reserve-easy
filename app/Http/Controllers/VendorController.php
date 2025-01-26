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
        $vendor = auth('vendor')->user();
        return view('vendor.show', compact('vendor'));

    }

    public function booking_management() {
        return view('vendor.booking_mgmt');
    }
    public function vendor_profile() {
        return view('vendor.vendor_profile');
    }
    public function vendor_setting() {
        return view('vendor.vendor_setting');
    }

}
