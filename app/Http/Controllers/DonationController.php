<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DropoffLocation;

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
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('donations.index')->with('error', 'Access denied.');
        }
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
        // Handles image upload and naming.
        $imageName = $request->hasFile('image')
            ? time() . '.' . $request->image->extension()
            : null;
        
        if ($imageName) {
            $request->image->move(public_path('images/donations'), $imageName);
        }

        // Create the donation record
        Donation::create([
            'title' => $request->title,
            'image' => $imageName, // Save image path in database
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
        $dropoffLocations = DropoffLocation::all(); // Get all drop-off locations

        return view('donations.show', compact('donation', 'dropoffLocations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        return view('donations.edit', compact('donation'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'category_custom' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string|max:1000',
            'availability' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional
        ]);

        // Handle image upload only if a new one is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($donation->image && file_exists(public_path('images/donations/' . $donation->image))) {
                unlink(public_path('images/donations/' . $donation->image));
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/donations'), $imageName);

            // Update the donation with the new image
            $donation->update([
                'image' => $imageName,
            ]);
        }

        // Update other donation details
        $donation->update($request->only(['title', 'category', 'category_custom', 'quantity', 'description', 'availability']));

        // Return success message only once
        return redirect()->route('donations.index')->with('success', 'Donation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return to_route('donations.index')->with('success', 'Donation deleted successfully!');
    }

    public function assignDropoff(Request $request, $donationId)
    {
        $request->validate([
            'dropoff_location_id' => 'required|exists:dropoff_locations,id',
        ]);
    
        $donation = Donation::findOrFail($donationId);
        $dropoffLocation = DropoffLocation::findOrFail($request->dropoff_location_id);
    
        // Attach the drop-off location
        $donation->dropoffLocations()->syncWithoutDetaching([$dropoffLocation->id]);
    
        return redirect()->back()->with('success', 'Drop-off location assigned successfully!');
    }
}
