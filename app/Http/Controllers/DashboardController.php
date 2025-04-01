<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $donations = auth()->user()->donations()
                        ->latest()
                        ->take(5)
                        ->get();
                        
        $offers = auth()->user()->offers()
                    ->with(['donation', 'donation.user'])
                    ->latest()
                    ->take(5)
                    ->get();
    
        return view('dashboard', compact('donations', 'offers'));
    }
}
