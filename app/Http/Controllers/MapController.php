<?php

namespace App\Http\Controllers;

use App\Services\MapService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MapController extends Controller
{
    protected MapService $mapService;

    public function __construct(MapService $mapService)
    {
        $this->mapService = $mapService;
    }

    /**
     * Display the member distribution map page.
     */
    public function index(): View
    {
        return view('map.index');
    }

    /**
     * Get member locations as JSON for map markers.
     */
    public function getMemberLocations(): JsonResponse
    {
        $locations = $this->mapService->getMemberLocations();
        
        return response()->json($locations);
    }
}
