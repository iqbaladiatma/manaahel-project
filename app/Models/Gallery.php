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
        'title',
        'file_path',
        'batch_filter',
        'visibility',
    ];

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
