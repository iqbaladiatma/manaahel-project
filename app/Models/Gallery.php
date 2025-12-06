<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file_path',
        'batch_filter',
        'visibility',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'array',
    ];

    /**
     * Relationship: Gallery belongs to a user (member_angkatan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get translated title.
     */
    public function getTranslatedTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        if (is_array($this->title)) {
            return $this->title[$locale] ?? $this->title['en'] ?? $this->title['id'] ?? 'Untitled';
        }
        
        return $this->title ?? 'Untitled';
    }

    /**
     * Scope a query to only include galleries visible to the user.
     */
    public function scopeVisibleForUser($query, ?User $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('visibility', 'public');
            
            if ($user) {
                $q->orWhere(function ($subQuery) use ($user) {
                    $subQuery->where('visibility', 'member_only')
                        ->where(function ($batchQuery) use ($user) {
                            $batchQuery->whereNull('batch_filter')
                                ->orWhere('batch_filter', $user->batch_year);
                        });
                });
            }
        });
    }

    /**
     * Scope a query to only include public galleries.
     */
    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    /**
     * Scope a query to only include member-only galleries.
     */
    public function scopeMemberOnly($query)
    {
        return $query->where('visibility', 'member_only');
    }

    /**
     * Check if the gallery is visible to the user.
     */
    public function isVisibleTo(?User $user): bool
    {
        if ($this->visibility === 'public') {
            return true;
        }

        if ($this->visibility === 'member_only' && $user) {
            if ($this->batch_filter === null) {
                return true;
            }
            return $this->batch_filter === $user->batch_year;
        }

        return false;
    }
}
