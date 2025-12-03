<?php

namespace App\Observers;

use App\Models\Program;
use Illuminate\Support\Facades\Cache;

class ProgramObserver
{
    /**
     * Handle the Program "created" event.
     */
    public function created(Program $program): void
    {
        Cache::forget('programs.active');
        Cache::forget('home.featured_programs');
    }

    /**
     * Handle the Program "updated" event.
     */
    public function updated(Program $program): void
    {
        Cache::forget('programs.active');
        Cache::forget('home.featured_programs');
    }

    /**
     * Handle the Program "deleted" event.
     */
    public function deleted(Program $program): void
    {
        Cache::forget('programs.active');
        Cache::forget('home.featured_programs');
    }

    /**
     * Handle the Program "restored" event.
     */
    public function restored(Program $program): void
    {
        Cache::forget('programs.active');
        Cache::forget('home.featured_programs');
    }

    /**
     * Handle the Program "force deleted" event.
     */
    public function forceDeleted(Program $program): void
    {
        Cache::forget('programs.active');
        Cache::forget('home.featured_programs');
    }
}
