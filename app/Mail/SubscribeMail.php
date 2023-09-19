<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Subscriber;
use App\Support\SettingsHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SubscribeMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** Create a new message instance. */
    public function __construct(
        protected Subscriber $subscriber,
    ) {
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(SettingsHelper::settings('company_email_address'), SettingsHelper::settings('site_title')),
            subject: $this->subscriber->name.' You are Subscribed to our Newsletters '.SettingsHelper::settings('site_title'),
        );
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.subscribe-mail',
            with: [
                'subscriber' => $this->subscriber,
            ],
        );
    }
}
