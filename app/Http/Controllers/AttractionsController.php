<?php
namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;

class AttractionsController extends Controller
{
    public function index()
    {
        $attractions = Attraction::all();
        return view('attractions', ['attractions' => $attractions]);
    }

    public function create()
    {
        return view('attractions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|url',
            'description_short' => 'required',
            'minimum_age' => 'required|integer',
            'minimum_height' => 'required|numeric',
            'maximum_weight' => 'required|numeric',
            'wait_time' => 'required|integer',
            'restrictions' => 'required',
            'inauguration_date' => 'required|date',
        ]);

        $attraction = new Attraction();

        $attraction->title = $validatedData["title"];  
        $attraction->description = $validatedData["description"];    
        $attraction->image = $validatedData["image"];
        $attraction->description_short = $validatedData["description_short"];
        $attraction->minimum_age = $validatedData["minimum_age"];
        $attraction->minimum_height = $validatedData["minimum_height"];
        $attraction->maximum_weight = $validatedData["maximum_weight"];
        $attraction->wait_time = $validatedData["wait_time"];
        $attraction->restrictions = $validatedData["restrictions"];
        $attraction->inauguration_date = $validatedData["inauguration_date"];

        $attraction->save();

        return redirect()->route('attractions');
    }

    public function edit($id)
    {
        $attraction = Attraction::findOrFail($id);
        return view('attractions.edit', compact('attraction'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|url',
            'description_short' => 'required',
            'minimum_age' => 'required|integer',
            'minimum_height' => 'required|numeric',
            'maximum_weight' => 'required|numeric',
            'wait_time' => 'required|integer',
            'restrictions' => 'required',
            'inauguration_date' => 'required|date',
        ]);

        $attraction = Attraction::findOrFail($id);

        $attraction->title = $validatedData["title"];  
        $attraction->description = $validatedData["description"];    
        $attraction->image = $validatedData["image"];
        $attraction->description_short = $validatedData["description_short"];
        $attraction->minimum_age = $validatedData["minimum_age"];
        $attraction->minimum_height = $validatedData["minimum_height"];
        $attraction->maximum_weight = $validatedData["maximum_weight"];
        $attraction->wait_time = $validatedData["wait_time"];
        $attraction->restrictions = $validatedData["restrictions"];
        $attraction->inauguration_date = $validatedData["inauguration_date"];

        $attraction->save();

        return redirect()->route('attractions');
    }

    public function destroy($id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();
        return redirect()->route('attractions');
    }
}
