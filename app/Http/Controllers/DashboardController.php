<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get authenticated user
        $user = auth()->user();
        
        // Get recent donations (last 5)
        $donations = $user->donations()
                        ->with('charity') // Eager load charity relationship
                        ->latest()
                        ->take(5)
                        ->get();
        
        // You can add more dashboard data here
        // For example:
        // $donationStats = $user->donations()->count();
        // $recentCharities = $user->charities()->latest()->take(3)->get();
        
        return view('dashboard', compact('donations'));
    }
}
