<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationNotification extends Notification
{
    use Queueable;
   /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    protected $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $participantName = $this->registration->participant->name;
        $raceName = $this->registration->race->name;
        $raceDate = $this->registration->race->date;

        return [
            'message' => __('New registration by :participant for the race ":race" on :date', [
                'participant' => $participantName,
                'race' => $raceName,
                'date' => $raceDate,
            ]),
        ];
    }
}
