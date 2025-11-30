<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasFactory, HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'program_id',
        'video_url',
        'content',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array<string>
     */
    public $translatable = ['title', 'content'];

    /**
     * Get the program that owns the course.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Check if the course is available for the member.
     */
    public function isAvailableForMember(User $member): bool
    {
        // If course is not associated with a program, it's available to all members
        if ($this->program_id === null) {
            return true;
        }

        // Check if member is enrolled in the program
        return $member->registrations()
            ->where('program_id', $this->program_id)
            ->where('status', 'approved')
            ->exists();
    }

    /**
     * Get the embed URL for the video.
     * Converts YouTube watch URLs to embed format.
     * Returns null if no video URL is set.
     */
    public function getEmbedUrl(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        // Check if it's a YouTube URL
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // If it's already an embed URL or a self-hosted video, return as is
        return $this->video_url;
    }
}
