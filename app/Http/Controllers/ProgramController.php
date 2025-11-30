<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Display a listing of active programs.
     */
    public function index(): View
    {
        $programs = Program::active()->get();
        
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
