<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DropoffLocation extends Model
{
    protected $fillable = ['location_name', 'address'];

    public function donations()
    {
        return $this->belongsToMany(Donation::class, 'donation_dropoff')->withTimestamps();
    }
}

