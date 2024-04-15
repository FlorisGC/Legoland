<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new Contact([
            'email' => $request->get('email'),
            'message' => $request->get('message')
        ]);

        $contact->save();

        return back()->with('success', 'Thanks for contacting us!');
    }
}
