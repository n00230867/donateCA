<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'donation_id',
        'user_id', 
        'comment', 
        'amount',
    ];

    // Offer.php
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Donation.php
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


}
