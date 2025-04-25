<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'registration_no',
        'image',
    ];


    public function donations()
    {
        return $this->belongsToMany(Donation::class);
    }
}
