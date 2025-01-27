<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor_uniqid extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_id', 'unique_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}