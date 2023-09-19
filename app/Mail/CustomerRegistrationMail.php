<?php

declare(strict_types=1);

namespace App\Mail;

use App\Support\SettingsHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Mail\Mailables\Address;

class CustomerRegistrationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /** @var \App\Models\User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.customer-registration')
            ->subject(__('Welcome!').' - '.$this->user->name)
            ->with([
                'user' => $this->user,
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(SettingsHelper::settings('company_email_address'), SettingsHelper::settings('site_title')),
            subject: sprintf('Welcome, %s!', $this->user->name),
        );
    }
}
