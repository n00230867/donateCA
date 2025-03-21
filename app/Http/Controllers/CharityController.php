<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CharityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all charities from the database
        $charities = Charity::all();

        // Pass them to the view
        return view('charities.index', compact('charities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('charities.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form input, including the image
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048', // Ensures only valid image types
            'registration_no' => 'nullable|string',
        ]);

        // Handle Image Upload
        // Handles image upload and naming.
        $imageName = $request->hasFile('image')
            ? time() . '.' . $request->image->extension()
            : null;
        
        if ($imageName) {
            $request->image->move(public_path('images/charities'), $imageName);
        }

        // Create the charity record
        Charity::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName, // Save image path in database
            'registration_no' => $request->registration_no,
        ]);

        return redirect()->route('charities.index')->with('success', 'Charity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Charity $charity)
    {
            return view('charities.show', compact('charity'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Charity $charity)
    {
        return view('charities.edit', compact('charity'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Charity $charity)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'registration_no' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional
        ]);

        // Handle image upload only if a new one is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($charity->image && file_exists(public_path('images/charities/' . $charity->image))) {
                unlink(public_path('images/charities/' . $charity->image));
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/charities'), $imageName);

            // Update the charity with the new image
            $charity->update([
                'image' => $imageName,
            ]);
        }

        // Update other charity details
        $charity->update($request->only(['title', 'description',  'registration_no']));

        // Return success message only once
        return redirect()->route('charities.index')->with('success', 'Charity updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Charity $charity)
    {
        $charity->delete();

        return to_route('charities.index')->with('success', 'Charity deleted successfully!');
    }
}
