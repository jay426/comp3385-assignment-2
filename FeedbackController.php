public function send(Request $request)
{
    // Validate the form inputs
    $validated = $request->validate([
        'fullname' => 'required|max:255',
        'email' => 'required|email',
        'comment' => 'required|max:500',
    ]);

    // If validation passes, continue with the email logic
    $fullname = $validated['fullname'];
    $email = $validated['email'];
    $comment = $validated['comment'];

    // Send the email using the Feedback Mailable
    Mail::to('your-email@example.com')->send(new Feedback($fullname, $email, $comment));

    // Redirect or return response
    return back()->with('success', 'Your feedback has been sent!');
}