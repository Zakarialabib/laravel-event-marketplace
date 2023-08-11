<?php

declare(strict_types=1);

namespace App\Mail;

use App\Helpers;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class TeamInvitationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** Create a new message instance. */
    public function __construct(
        public $team,
        public $participant,
    ) {
        $this->team = $team;
        $this->participant = $participant;
    }

    /** Get the message envelope. */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(Helpers::settings('company_email_address'), Helpers::settings('site_title')),
            subject: 'You are invited to Team'.'-'.$this->team->team_name.'-'.Helpers::settings('site_title'),
        );
    }

    /** Get the message content definition. */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.team-invitation',
            with: [
                'subscriber'  => $this->team,
                'participant' => $this->participant,
            ],
        );
    }
}
