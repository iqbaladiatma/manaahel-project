<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\CloudinaryService;

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
        'folder',
        'file_path',
        'cloudinary_public_id',
        'file_type',
        'batch_filter',
        'visibility',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Relationship: Gallery belongs to a user (member_angkatan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get title.
     */
    public function getTranslatedTitle($locale = null)
    {
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
                            // Admin can see all galleries regardless of batch
                            if ($user->role === 'admin') {
                                $batchQuery->whereRaw('1 = 1'); // Always true for admin
                            } else {
                                $batchQuery->whereNull('batch_filter')
                                    ->orWhere('batch_filter', $user->batch_year);
                            }
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

    /**
     * Get the Cloudinary image URL
     */
    public function getImageUrl($options = [])
    {
        if ($this->cloudinary_public_id) {
            return CloudinaryService::getImageUrl($this->cloudinary_public_id, $options);
        }
        
        return $this->file_path;
    }

    /**
     * Get the Cloudinary video URL
     */
    public function getVideoUrl($options = [])
    {
        if ($this->cloudinary_public_id && $this->file_type === 'video') {
            return CloudinaryService::getVideoUrl($this->cloudinary_public_id, $options);
        }
        
        return $this->file_path;
    }

    /**
     * Get video thumbnail
     */
    public function getVideoThumbnail($options = [])
    {
        if ($this->cloudinary_public_id && $this->file_type === 'video') {
            return CloudinaryService::getVideoThumbnail($this->cloudinary_public_id, $options);
        }
        
        return null;
    }

    /**
     * Check if this gallery item is a video
     */
    public function isVideo()
    {
        return $this->file_type === 'video';
    }

    /**
     * Check if this gallery item is an image
     */
    public function isImage()
    {
        return $this->file_type === 'image';
    }
}
