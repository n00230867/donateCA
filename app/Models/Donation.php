<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'title',
        'image',
        'category',
        'quantity',
        'description',
        'availability',
    ];

    public function dropoffLocations()
    {
        return $this->belongsToMany(DropoffLocation::class, 'donations_dropoff');
    }
}

