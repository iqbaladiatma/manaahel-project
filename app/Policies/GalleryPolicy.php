<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\User;

class GalleryPolicy
{
    /**
     * Determine whether the user can view the gallery.
     */
    public function view(?User $user, Gallery $gallery): bool
    {
        return $gallery->isVisibleTo($user);
    }
}
