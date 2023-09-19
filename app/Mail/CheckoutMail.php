<?php

declare(strict_types=1);

namespace App\Mail;

use App\Support\SettingsHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\User;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;

class CheckoutMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** Create a new message instance. */
    public function __construct(
        public Order $order,
        public User $user,
    ) {
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.checkout',
            with: [
                'url'   => route('front.myaccount'),
                'order' => $this->order,
                'user'  => $this->user,
            ],
        );
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(SettingsHelper::settings('company_email_address'), SettingsHelper::settings('site_title')),
            subject: $this->order->reference.__(' Order reference').' - '.SettingsHelper::settings('site_title'),
        );
    }
}
