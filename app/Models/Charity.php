<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
