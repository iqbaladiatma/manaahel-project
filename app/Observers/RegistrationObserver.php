<?php

namespace App\Observers;

use App\Models\Registration;
use Illuminate\Support\Facades\Cache;

class RegistrationObserver
{
    /**
     * Handle the Registration "created" event.
     */
    public function created(Registration $registration): void
    {
        Cache::forget('dashboard.pending_registrations');
    }

    /**
     * Handle the Registration "updated" event.
     */
    public function updated(Registration $registration): void
    {
        Cache::forget('dashboard.pending_registrations');
    }

    /**
     * Handle the Registration "deleted" event.
     */
    public function deleted(Registration $registration): void
    {
        Cache::forget('dashboard.pending_registrations');
    }

    /**
     * Handle the Registration "restored" event.
     */
    public function restored(Registration $registration): void
    {
        Cache::forget('dashboard.pending_registrations');
    }

    /**
     * Handle the Registration "force deleted" event.
     */
    public function forceDeleted(Registration $registration): void
    {
        Cache::forget('dashboard.pending_registrations');
    }
}
