<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Feedback extends Mailable
{
    use Queueable, SerializesModels;

    public string $fullname;
    public string $email;
    public string $comment;

    /**
     * Create a new message instance.
     *
     * @param string $fullname
     * @param string $email
     * @param string $comment
     */
    public function __construct(string $fullname, string $email, string $comment)
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Feedback from ' . $this->fullname)
                    ->from($this->email, $this->fullname)
                    ->view('mail.feedback') // This is where we link to the view
                    ->with([
                        'fullname' => $this->fullname,
                        'email' => $this->email,
                        'comment' => $this->comment,
                    ]);
    }

    /**
     * The envelope for the email (optional).
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->fullname), // Email sent from user
            subject: 'Feedback from ' . $this->fullname
        );
    }

    /**
     * The content for the email (optional).
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.feedback', // The view you created for the email body
        );
    }
}