<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Registration;
use App\Models\User;
use App\Notifications\RegistrationNotification;

class RegistrationObserver
{
    /** Handle the Registration "created" event. */
    public function created(Registration $registration): void
    {
        $admin = User::whereHas('roles', static function ($query): void {
            $query->where('name', 'admin');
        })->first();

        if ($admin) {
            $admin->notify(new RegistrationNotification($registration));
        }
    }

    /** Handle the Registration "updated" event. */
    public function updated(Registration $registration): void
    {
    }

    /** Handle the Registration "deleted" event. */
    public function deleted(Registration $registration): void
    {
    }

    /** Handle the Registration "restored" event. */
    public function restored(Registration $registration): void
    {
    }

    /** Handle the Registration "force deleted" event. */
    public function forceDeleted(Registration $registration): void
    {
    }
}
