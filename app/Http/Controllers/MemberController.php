<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Display a listing of members (protected route).
     */
    public function index(Request $request): View
    {
        // Show only member_angkatan
        $query = User::where('role', 'member_angkatan');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        // Filter by batch year
        if ($request->has('batch_year') && $request->batch_year) {
            $query->where('batch_year', $request->batch_year);
        }

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        $members = $query->orderBy('name', 'asc')->paginate(12);

        // Get available batch years for filter
        $batchYears = User::where('role', 'member_angkatan')
            ->whereNotNull('batch_year')
            ->distinct()
            ->pluck('batch_year')
            ->sort()
            ->values();

        return view('members.index', compact('members', 'batchYears'));
    }

    /**
     * Display the specified member profile.
     */
    public function show(User $member): View
    {
        // Only show member_angkatan
        if ($member->role !== 'member_angkatan') {
            abort(404);
        }

        // Load galleries for member angkatan
        if ($member->isMemberAngkatan()) {
            $member->load(['galleries' => function($query) {
                $query->latest()->take(6);
            }]);
        }

        return view('members.show', compact('member'));
    }
}
