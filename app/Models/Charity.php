<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'registration_no',
        'image',
    ];

    public function dropoffLocations()
    {
        return $this->hasMany(DropoffLocation::class);
    }
}
