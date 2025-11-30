<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class MapService
{
    /**
     * Get all members with location coordinates.
     */
    public function getMemberLocations(): array
    {
        $members = User::members()
            ->withLocation()
            ->get(['id', 'name', 'batch_year', 'latitude', 'longitude', 'avatar_url']);
        
        return $this->formatMarkerData($members);
    }

    /**
     * Format member data for Leaflet.js markers.
     */
    public function formatMarkerData(Collection $members): array
    {
        return $members->map(function ($member) {
            return [
                'id' => $member->id,
                'name' => $member->name,
                'batch_year' => $member->batch_year,
                'latitude' => (float) $member->latitude,
                'longitude' => (float) $member->longitude,
                'avatar_url' => $member->avatar_url,
            ];
        })->toArray();
    }
}
