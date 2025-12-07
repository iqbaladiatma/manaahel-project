<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'content',
        'video_url',
        'duration_minutes',
        'order',
        'is_published',
        'delivery_type',
        'meeting_link',
        'scheduled_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'scheduled_at' => 'datetime',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserModuleProgress::class);
    }

    public function scopePublished($query)
    {
        return $this->where('is_published', true);
    }
}