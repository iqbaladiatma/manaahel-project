<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder',
        'description',
        'created_by'
    ];

    /**
     * Get the user who created this folder
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get galleries in this folder
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'folder', 'folder');
    }

    /**
     * Get count of files in this folder
     */
    public function getFileCountAttribute()
    {
        return $this->galleries()->count();
    }
}
