<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        "vendor_id",
        "client_id",
        "booking_date",
        "guest",
        "shift",
        "type",
        "status",
    ];

     /**
     * Get the vendor associated with the booking.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the client associated with the booking.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
