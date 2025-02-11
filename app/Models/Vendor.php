<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'business_type',
        'phone',
        'description',
        'logo',
        'website',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function vendorUniqId()
    {
        return $this->hasOne(vendor_uniqid::class, 'vendor_id', 'id');
    }

    /**
     * Get the bookings for the vendor.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
