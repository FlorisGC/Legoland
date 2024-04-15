<?php
namespace App\Http\Controllers;

use App\Models\Attraction;

class AttractionsController extends Controller
{
    public function index()
    {
        $attractions = Attraction::all();
        return view('attractions', ['attractions' => $attractions]);
    }
}