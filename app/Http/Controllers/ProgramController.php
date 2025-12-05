<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Display a listing of active programs.
     * Cache active programs list for 30 minutes.
     */
    public function index(Request $request): View
    {
        $query = Program::active();

        // Filter by type if provided
        if ($request->has('type') && in_array($request->type, ['academy', 'competition'])) {
            $query->where('type', $request->type);
        }

        $programs = $query->orderBy('created_at', 'desc')->paginate(12);
        
        return view('programs.index', compact('programs'));
    }

    /**
     * Display the specified program details in selected language.
     */
    public function show(Program $program): View
    {
        // Load courses with modules and schedules
        $program->load([
            'courses.modules' => function($query) {
                $query->published()->orderBy('order');
            },
            'schedules' => function($query) {
                $query->orderBy('scheduled_at');
            }
        ]);

        $isEnrolled = false;
        if (auth()->check()) {
            $isEnrolled = \App\Models\Registration::where('user_id', auth()->id())
                ->where('program_id', $program->id)
                ->where('status', 'approved')
                ->exists();
        }

        return view('programs.show', compact('program', 'isEnrolled'));
    }
}
