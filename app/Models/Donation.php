<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'category',
        'quantity',
        'description',
        'availability',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function charities()
    {
        return $this->belongsToMany(Charity::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

}

