<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'program_schedule_id',
        'attended_at',
        'status',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
    ];

    /**
     * Get the user that attended.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the program schedule.
     */
    public function programSchedule(): BelongsTo
    {
        return $this->belongsTo(ProgramSchedule::class);
    }
}
