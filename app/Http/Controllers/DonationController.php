<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all donations from the database
        $donations = Donation::all();

        // Pass them to the view
        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donations.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|string|max:255',
            'category_custom' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,pending,unavailable',
        ]);
    
        // Use custom category if provided
        $category = $request->category === 'Custom' ? $request->category_custom : $request->category;
    
        // Handle image upload
        $path = $request->file('image') ? $request->file('image')->store('donations', 'public') : null;
    
        Donation::create([
            'title' => $request->title,
            'image' => $path,
            'category' => $category, // Save category
            'quantity' => $request->quantity,
            'description' => $request->description,
            'availability' => $request->availability,
        ]);
    
        return redirect()->route('donations.index')->with('success', 'Donation Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
            return view('donations.show', compact('donation'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
