<?php

declare(strict_types=1);

namespace App\Mail;

use App\Support\SettingsHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;
use Illuminate\Mail\Mailables\Address;

class ContactFormMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** Create a new message instance. */
    public function __construct(
        protected Contact $contact,
    ) {
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-form',
            with: [
                'contact' => $this->contact,
            ],
        );
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(SettingsHelper::settings('company_email_address'), SettingsHelper::settings('site_title')),
            subject: 'New Contact from '.$this->contact->name.' - '.SettingsHelper::settings('site_title'),
        );
    }
}
