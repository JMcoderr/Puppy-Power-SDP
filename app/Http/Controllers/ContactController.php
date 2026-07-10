<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

// handles the public contact form
class ContactController extends Controller
{
    // show the contact page with an empty form
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        // validate all fields before saving to the database
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            // subject must be one of the predefined dropdown options
            'subject' => ['required', 'string', 'in:Vraag over training,Vraag over dagopvang,Vraag over een product,Overige vraag'],
            // allow a longer message body but cap it to avoid huge payloads
            'message' => ['required', 'string', 'max:4000'],
        ]);

        ContactMessage::query()->create($validated);

        // redirect back to the same page with a success flash message
        return back()->with('status', 'Bericht verstuurd! We reageren zo snel mogelijk.');
    }
}
