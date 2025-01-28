<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor_uniqid extends Model
{
    use HasFactory;

    protected $table = 'vendor_uniqid';

    protected $fillable = ['vendor_id', 'unique_id'];

     // Define the reverse relationship
     public function vendor()
     {
         return $this->belongsTo(Vendor::class, 'vendor_id');
     }
}