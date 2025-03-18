<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        // Validate form input, including the image
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048', // Ensures only valid image types
            'category' => 'required|string|max:255',
            'category_custom' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,pending,unavailable',
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('donations', 'public'); 
        }

        // Create the donation record
        Donation::create([
            'title' => $request->title,
            'image' => $imagePath, // Save image path in database
            'category' => $request->category,
            'category_custom' => $request->category_custom,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'availability' => $request->availability,
        ]);

        return redirect()->route('donations.index')->with('success', 'Donation created successfully!');
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
