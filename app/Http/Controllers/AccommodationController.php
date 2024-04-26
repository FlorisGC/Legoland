<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationOrder;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::all();
        return view('accommodations', ['accommodations' => $accommodations]);
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

        $accommodation = Accommodation::find($request->accommodation_id);

        return back()->with('message', 'Order placed successfully!')
            ->with('order', [
                'number_of_nights' => $request->number_of_nights,
                'accommodation_type' => $accommodation->type,
            ]);
    }
}
