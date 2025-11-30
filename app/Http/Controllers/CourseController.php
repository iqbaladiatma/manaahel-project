<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of courses available to the authenticated member.
     */
    public function index(Request $request)
    {
        // Require authentication
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // Get all courses and filter by availability
        $courses = Course::all()->filter(function ($course) use ($user) {
            return $course->isAvailableForMember($user);
        });

        return view('courses.index', compact('courses'));
    }

    /**
     * Display the specified course.
     */
    public function show(Request $request, Course $course)
    {
        // Check authentication and authorization
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Use policy to check if user can view this course
        Gate::authorize('view', $course);

        return view('courses.show', compact('course'));
    }
}
