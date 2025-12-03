<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of courses available to the authenticated member.
     * Eager load program relationship to prevent N+1 queries.
     */
    public function index(Request $request)
    {
        // Require authentication
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // Eager load program relationship to prevent N+1 queries
        $courses = Course::with('program')->get()->filter(function ($course) use ($user) {
            return $course->isAvailableForMember($user);
        });

        return view('courses.index', compact('courses'));
    }

    /**
     * Display the specified course.
     * Eager load program relationship.
     */
    public function show(Request $request, Course $course)
    {
        // Check authentication and authorization
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Use policy to check if user can view this course
        Gate::authorize('view', $course);

        // Eager load program relationship
        $course->load('program');

        return view('courses.show', compact('course'));
    }
}
