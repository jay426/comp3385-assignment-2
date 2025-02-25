<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Show the feedback form
    public function create()
    {
        return view('feedback-form');
    }

    // Handle the form submission
    public function send(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // For now, just return back with a success message
        return back()->with('success', 'Thank you for your feedback!');
    }
}