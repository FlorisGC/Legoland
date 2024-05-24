<?php

namespace App\Http\Controllers;

use App\Models\Openinghour;
use Illuminate\Http\Request;

class OpeningHoursController extends Controller
{
    public function index()
    {
        $openingHours = Openinghour::all();
        return view('opening-hours', ['openingHours' => $openingHours]);
    }

    public function edit($id)
    {
        $openingHour = Openinghour::findOrFail($id);
        return view('edit-opening-hour', compact('openingHour'));
    }

    public function update(Request $request, $id)
    {
        $openingHour = Openinghour::findOrFail($id);
        $openingHour->update($request->only(['day', 'open', 'close']));
        return redirect()->route('opening-hours');
    }

}
