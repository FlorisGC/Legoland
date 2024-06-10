<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::all();
        $isAuthenticated = Auth::check();
        return view('accommodations', ['accommodations' => $accommodations, 'isAuthenticated' => $isAuthenticated]);
    }

    public function placeAccommodationOrder(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'accommodation_id' => 'required|exists:accommodations,id',
            'number_of_nights' => 'required|integer|min:1',
        ]);

        if ($request->number_of_nights < 1) {
            return back()->with('message', 'Please order at least one night');
        }

        $order = new AccommodationOrder;
        $order->email = $request->email;
        $order->accommodation_id = $request->accommodation_id;
        $order->number_of_nights = $request->number_of_nights;
        $order->save();

        return back()->with('message', 'Order placed successfully!');
    }

    public function create()
    {
        return view('accommodations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'image' => 'required|string',
        ]);

        $accommodation = Accommodation::create($request->all());

        return response()->json($accommodation);
    }

    public function edit($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        
        if (Auth::check()) {
            return view('accommodations.edit', compact('accommodation'));
        } else {
            return redirect()->route('accommodations')->with('error', 'You must be logged in to edit accommodations.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'image' => 'required|string',
        ]);

        $accommodation = Accommodation::findOrFail($id);
        
        if (Auth::check()) {
            $accommodation->update($request->all());
            return response()->json(['success' => true, 'message' => 'Accommodation updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'You must be logged in to update accommodations.'], 403);
        }
    }

    public function destroy($id)
    {
        $accommodation = Accommodation::findOrFail($id);
            
        if (Auth::check()) {
            $accommodation->delete();
            return response()->json(['success' => true, 'message' => 'Accommodation deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'You must be logged in to delete accommodations.'], 403);
        }
    }
}
