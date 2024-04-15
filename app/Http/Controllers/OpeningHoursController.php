<?php

namespace App\Http\Controllers;

use App\Models\Openinghour;

class OpeningHoursController extends Controller
{
    public function index()
    {
        $openingHours = Openinghour::all();
        return view('opening-hours', ['openingHours' => $openingHours]);
    }
}
