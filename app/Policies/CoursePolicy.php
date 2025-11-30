<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Determine whether the user can view the course.
     */
    public function view(?User $user, Course $course): bool
    {
        // E-learning requires authentication
        if ($user === null) {
            return false;
        }

        // Check if course is available for the member
        return $course->isAvailableForMember($user);
    }
}
