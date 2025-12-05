<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index(Request $request): View
    {
        $query = Course::with('program')->where('is_published', true);

        // Filter by program
        if ($request->has('program') && $request->program) {
            $query->where('program_id', $request->program);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title->en', 'like', "%{$search}%")
                  ->orWhere('title->id', 'like', "%{$search}%")
                  ->orWhere('description->en', 'like', "%{$search}%")
                  ->orWhere('description->id', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('order')->paginate(12);

        // Get programs for filter
        $programs = Program::where('status', true)->get();

        return view('courses.index', compact('courses', 'programs'));
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course): View
    {
        // Check if course is published
        if (!$course->is_published) {
            abort(404);
        }

        $course->load(['program', 'modules' => function($query) {
            $query->where('is_published', true)->orderBy('order');
        }]);

        // Get related courses from same program
        $relatedCourses = Course::where('program_id', $course->program_id)
            ->where('id', '!=', $course->id)
            ->where('is_published', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('courses.show', compact('course', 'relatedCourses'));
    }
}
