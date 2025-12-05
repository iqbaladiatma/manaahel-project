<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Program;
use App\Models\Registration;
use App\Models\UserModuleProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EnrolledProgramController extends Controller
{
    /**
     * Display list of user's enrolled programs.
     */
    public function index(): View
    {
        $enrolledPrograms = Registration::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->with(['program.courses', 'program.schedules'])
            ->get();

        return view('enrolled.index', compact('enrolledPrograms'));
    }

    /**
     * Display enrolled program detail with syllabus and content.
     */
    public function show(Program $program): View
    {
        // Check if user is enrolled and approved
        $registration = Registration::where('user_id', Auth::id())
            ->where('program_id', $program->id)
            ->where('status', 'approved')
            ->firstOrFail();

        $program->load(['courses.modules' => function($query) {
            $query->published()->orderBy('order');
        }, 'schedules' => function($query) {
            $query->with('attendances')->orderBy('scheduled_at');
        }]);

        // Get user's attendances for this program's schedules
        $userAttendances = \App\Models\Attendance::where('user_id', Auth::id())
            ->whereIn('program_schedule_id', $program->schedules->pluck('id'))
            ->get()
            ->keyBy('program_schedule_id');

        // Logic to find next module to learn
        $nextModule = null;
        $nextCourse = null;
        
        if ($program->delivery_type === 'online_course') {
            // Get all modules IDs in order
            $allModules = collect();
            foreach ($program->courses as $course) {
                foreach ($course->modules as $module) {
                    $allModules->push([
                        'module' => $module,
                        'course' => $course
                    ]);
                }
            }
            
            // Get completed modules
            $completedModuleIds = UserModuleProgress::where('user_id', Auth::id())
                ->where('is_completed', true)
                ->whereIn('course_module_id', $allModules->pluck('module.id'))
                ->pluck('course_module_id')
                ->toArray();
                
            // Find first uncompleted module
            foreach ($allModules as $item) {
                if (!in_array($item['module']->id, $completedModuleIds)) {
                    $nextModule = $item['module'];
                    $nextCourse = $item['course'];
                    break;
                }
            }
            
            // If all completed, or none started, default to first
            if (!$nextModule && $allModules->isNotEmpty()) {
                $nextModule = $allModules->first()['module'];
                $nextCourse = $allModules->first()['course'];
            }
        }

        return view('enrolled.show', compact('program', 'registration', 'userAttendances', 'nextModule', 'nextCourse'));
    }

    /**
     * Mark attendance for a schedule.
     */
    public function markAttendance(Request $request, Program $program, $scheduleId)
    {
        // Check if user is enrolled
        Registration::where('user_id', Auth::id())
            ->where('program_id', $program->id)
            ->where('status', 'approved')
            ->firstOrFail();

        $schedule = \App\Models\ProgramSchedule::findOrFail($scheduleId);

        // Check if attendance is enabled for this schedule
        if (!$schedule->attendance_enabled) {
            return response()->json([
                'success' => false,
                'message' => __('Attendance is not available for this session yet.'),
            ], 403);
        }

        // Check if schedule belongs to this program
        if ($schedule->program_id !== $program->id) {
            abort(404);
        }

        // Create or update attendance
        $attendance = \App\Models\Attendance::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'program_schedule_id' => $scheduleId,
            ],
            [
                'attended_at' => now(),
                'status' => 'present',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => __('Attendance marked successfully!'),
            'attended_at' => $attendance->attended_at->format('d M Y H:i'),
        ]);
    }

    /**
     * Display course module detail with video player and progress tracking.
     */
    public function showModule(Program $program, Course $course, CourseModule $module): View
    {
        // Check if user is enrolled
        $registration = Registration::where('user_id', Auth::id())
            ->where('program_id', $program->id)
            ->where('status', 'approved')
            ->firstOrFail();

        // Check if module belongs to this course
        if ($module->course_id !== $course->id) {
            abort(404);
        }

        // Check if course belongs to this program
        if ($course->program_id !== $program->id) {
            abort(404);
        }

        // Get user progress for this module
        $progress = UserModuleProgress::firstOrCreate([
            'user_id' => Auth::id(),
            'course_module_id' => $module->id,
        ]);

        // Get all modules for sidebar navigation
        $allModules = CourseModule::where('course_id', $course->id)
            ->published()
            ->orderBy('order')
            ->get();

        // Get user progress for all modules in this course
        $moduleProgress = UserModuleProgress::where('user_id', Auth::id())
            ->whereIn('course_module_id', $allModules->pluck('id'))
            ->get()
            ->keyBy('course_module_id');

        // Calculate course completion percentage
        $completedModules = $moduleProgress->where('is_completed', true)->count();
        $totalModules = $allModules->count();
        $completionPercentage = $totalModules > 0 ? round(($completedModules / $totalModules) * 100) : 0;

        return view('enrolled.module', compact(
            'program',
            'course',
            'module',
            'progress',
            'allModules',
            'moduleProgress',
            'completionPercentage'
        ));
    }

    /**
     * Mark module as completed.
     */
    public function completeModule(Request $request, Program $program, Course $course, CourseModule $module)
    {
        // Check if user is enrolled
        Registration::where('user_id', Auth::id())
            ->where('program_id', $program->id)
            ->where('status', 'approved')
            ->firstOrFail();

        $progress = UserModuleProgress::where('user_id', Auth::id())
            ->where('course_module_id', $module->id)
            ->firstOrFail();

        if (!$progress->is_completed) {
            $progress->update([
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('Module marked as completed'),
        ]);
    }

    /**
     * Unmark module as completed.
     */
    public function uncompleteModule(Request $request, Program $program, Course $course, CourseModule $module)
    {
        // Check if user is enrolled
        Registration::where('user_id', Auth::id())
            ->where('program_id', $program->id)
            ->where('status', 'approved')
            ->firstOrFail();

        $progress = UserModuleProgress::where('user_id', Auth::id())
            ->where('course_module_id', $module->id)
            ->firstOrFail();

        if ($progress->is_completed) {
            $progress->update([
                'is_completed' => false,
                'completed_at' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('Module marked as incomplete'),
        ]);
    }
}
