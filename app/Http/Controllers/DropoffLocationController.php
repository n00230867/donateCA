<?php

namespace App\Http\Controllers;

use App\Models\DropoffLocation;
use Illuminate\Http\Request;

class DropoffLocationController extends Controller
{
    public function store(Request $request)
    {
        $dropoffLocation = DropoffLocation::create([
            'charity_id' => $request->charity_id,
            'location_name' => $request->location_name,
            'cord' => $request->cord,
            'collection_point' => $request->collection_point,
        ]);

        return response()->json(['message' => 'Drop-off location created', 'dropoffLocation' => $dropoffLocation]);
    }

    public function index()
    {
        return DropoffLocation::with('charity')->get();
    }
}

