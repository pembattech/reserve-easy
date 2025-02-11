<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'booking_source',
        'OPT',
        'is_valid',
    ];

     /**
     * Get the bookings for the client.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
