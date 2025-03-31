<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Donation;


class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = $donation->offers()->with('user')->get();
        return view('offers.index', compact('donation', 'offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Donation $donation)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'comment' => 'nullable|string|max:500',
        ]);

        $donation->offers()->create([
            'donation_id' => $donation->id,
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'comment' => $request->comment,
        ]);

        return redirect()->route('donations.show', $donation)->with('success', 'Offer Submitted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation, Offer $offer)
    {
        if (auth()->user()->id !== $offer->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('donations.index')->with('error', 'Unauthorized');
        }

        return view('offers.edit', compact('offer'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation, Offer $offer)
    {
        $review->update($request->only(['amount', 'comment']));

        return redirect()->route('donations.show', $donation)->with('success', 'Offer updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation, Offer $offer)
    {
        $offer->delete();

        return redirect()->route('donations.show', $donation)->with('success', 'Offer deleted successfully!');

    }

}
