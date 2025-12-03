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
    public function index(): View
    {
        // Note: Pagination cannot be cached directly, so we paginate the query
        $programs = Program::active()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('programs.index', compact('programs'));
    }

    /**
     * Display the specified program details in selected language.
     */
    public function show(Program $program): View
    {
        return view('programs.show', compact('program'));
    }
}
