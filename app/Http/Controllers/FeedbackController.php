<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    // Display the feedback form
    public function create()
    {
        return view('feedback-form');
    }

    // Handle the form submission and send the email
    public function send(Request $request)
    {
        // Validate the incoming form data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        // Retrieve the validated form data
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $comment = $request->input('comment');

        // Send the email using the Feedback Mailable class
        Mail::to('comp3385@uwi.edu', 'COMP3385 Course Admin') // Send to the admin email
            ->send(new Feedback($fullname, $email, $comment)); // Send the feedback email

        // Redirect to a success page with a success message
        return redirect('/feedback/success')->with('message', 'Thank you for your feedback!');
    }

    // Show the success page
    public function success()
    {
        return view('feedback-success'); // The success view after form submission
    }
}