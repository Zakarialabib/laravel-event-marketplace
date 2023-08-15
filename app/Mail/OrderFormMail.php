<?php

declare(strict_types=1);

namespace App\Mail;

use App\Helpers;
use App\Models\OrderForms;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderFormMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** Create a new message instance. */
    public function __construct(
        protected OrderForms $orderForm,
    ) {
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.order-form-mail',
            with: [
                'orderForm' => $this->orderForm,
            ],
        );
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->orderForm->name.' Request Order - '.Helpers::settings('site_title'),
        );
    }
}
