<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Participant;
use App\Support\SettingsHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class RegistrationConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** Create a new message instance. */
    public function __construct(
        protected Participant $participant,
    ) {
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.registration-confirmation',
            with: [
                'participant' => $this->participant,
                'url'         => route('front.myaccount'),
            ],
        );
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->participant->name.' Registration Confirmation - '.SettingsHelper::settings('site_title'),
        );
    }
}
