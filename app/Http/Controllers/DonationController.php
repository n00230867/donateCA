<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Offer;
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
        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // No need to restrict creation to admin only if regular users should create donations
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
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'category' => 'required|string|max:255',
            'category_custom' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'availability' => 'required|in:available,pending,unavailable',
        ]);

        // Handle Image Upload
        $imageName = $request->hasFile('image')
            ? time() . '.' . $request->image->extension()
            : null;
        
        if ($imageName) {
            $request->image->move(public_path('images/donations'), $imageName);
        }

        // Create the donation record with the user_id
        Donation::create([
            'title' => $request->title,
            'image' => $imageName,
            'category' => $request->category,
            'category_custom' => $request->category_custom,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'availability' => $request->availability,
            'user_id' => auth()->id(), // Add the current user's ID
        ]);

        return redirect()->route('donations.index')->with('success', 'Donation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        $donation->load('offers.user');
        return view('donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        // Check if the authenticated user is the creator of the donation
        if (auth()->id() !== $donation->user_id) {
            return redirect()->route('donations.index')->with('error', 'You can only edit your own donations.');
        }

        return view('donations.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        // Check if the authenticated user is the creator of the donation
        if (auth()->id() !== $donation->user_id) {
            return redirect()->route('donations.index')->with('error', 'You can only update your own donations.');
        }

        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'category_custom' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string|max:1000',
            'availability' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($donation->image && file_exists(public_path('images/donations/' . $donation->image))) {
                unlink(public_path('images/donations/' . $donation->image));
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/donations'), $imageName);
            $donation->image = $imageName;
        }

        // Update donation
        $donation->update($request->only(['title', 'category', 'category_custom', 'quantity', 'description', 'availability']));

        return redirect()->route('donations.index')->with('success', 'Donation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        // Check if the authenticated user is the creator of the donation
        if (auth()->id() !== $donation->user_id) {
            return redirect()->route('donations.index')->with('error', 'You can only delete your own donations.');
        }

        // Delete the image if it exists
        if ($donation->image && file_exists(public_path('images/donations/' . $donation->image))) {
            unlink(public_path('images/donations/' . $donation->image));
        }

        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully!');
    }


    public function myDonations()
    {
        $donations = auth()->user()->donations()->with('charity')->latest()->get();
        return view('donations.my-donations', compact('donations'));
    }
}