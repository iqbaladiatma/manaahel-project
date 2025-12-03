<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Cache::forget('dashboard.members_count');
        Cache::forget('map.member_locations');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Cache::forget('dashboard.members_count');
        Cache::forget('map.member_locations');
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Cache::forget('dashboard.members_count');
        Cache::forget('map.member_locations');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        Cache::forget('dashboard.members_count');
        Cache::forget('map.member_locations');
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        Cache::forget('dashboard.members_count');
        Cache::forget('map.member_locations');
    }
}
