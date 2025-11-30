<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\MapService;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MapPropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 19: Members with coordinates appear on map**
     * 
     * For any member who has provided latitude and longitude coordinates, 
     * a marker should appear on the distribution map at that location.
     * 
     * **Validates: Requirements 6.1**
     */
    #[Test]
    public function members_with_coordinates_appear_on_map()
    {
        $this->forAll(
            Generator\choose(1, 10), // Number of members to create
            Generator\float(-90.0, 90.0), // Latitude range
            Generator\float(-180.0, 180.0) // Longitude range
        )
        ->withMaxSize(100)
        ->then(function ($count, $baseLat, $baseLng) {
            // Clear all existing users before each iteration
            User::query()->delete();
            
            $mapService = new MapService();
            $createdMembers = [];
            
            // Create members with coordinates
            for ($i = 0; $i < $count; $i++) {
                // Add small variations to avoid exact duplicates
                $lat = $baseLat + ($i * 0.1);
                $lng = $baseLng + ($i * 0.1);
                
                // Ensure coordinates stay within valid ranges
                $lat = max(-90.0, min(90.0, $lat));
                $lng = max(-180.0, min(180.0, $lng));
                
                $member = User::create([
                    'name' => "Member {$i}",
                    'email' => "member{$i}_" . uniqid() . "@example.com",
                    'password' => bcrypt('password'),
                    'role' => $i % 2 === 0 ? 'user' : 'member',
                    'batch_year' => 2020 + ($i % 5),
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'email_verified_at' => now(),
                ]);
                
                $createdMembers[] = $member;
            }
            
            // Get member locations from the service
            $locations = $mapService->getMemberLocations();
            
            // Verify that all created members appear in the locations
            $this->assertCount($count, $locations, "All {$count} members with coordinates should appear in the map data");
            
            foreach ($createdMembers as $member) {
                $found = false;
                foreach ($locations as $location) {
                    if ($location['id'] === $member->id) {
                        $found = true;
                        
                        // Verify the coordinates match
                        $this->assertEquals(
                            (float) $member->latitude,
                            $location['latitude'],
                            "Latitude for member {$member->id} should match"
                        );
                        
                        $this->assertEquals(
                            (float) $member->longitude,
                            $location['longitude'],
                            "Longitude for member {$member->id} should match"
                        );
                        
                        // Verify other member data is included
                        $this->assertEquals($member->name, $location['name']);
                        $this->assertEquals($member->batch_year, $location['batch_year']);
                        
                        break;
                    }
                }
                
                $this->assertTrue(
                    $found,
                    "Member {$member->id} with coordinates should appear in the map locations"
                );
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 20: Coordinate updates reflect on map**
     * 
     * For any member who updates their location coordinates, the distribution 
     * map should include a marker at the new location.
     * 
     * **Validates: Requirements 6.2**
     */
    #[Test]
    public function coordinate_updates_reflect_on_map()
    {
        $this->forAll(
            Generator\float(-90.0, 90.0), // Initial latitude
            Generator\float(-180.0, 180.0), // Initial longitude
            Generator\float(-90.0, 90.0), // Updated latitude
            Generator\float(-180.0, 180.0) // Updated longitude
        )
        ->withMaxSize(100)
        ->then(function ($initialLat, $initialLng, $updatedLat, $updatedLng) {
            // Clear all existing users before each iteration
            User::query()->delete();
            
            $mapService = new MapService();
            
            // Create a member with initial coordinates
            $member = User::create([
                'name' => 'Test Member',
                'email' => 'member_' . uniqid() . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'member',
                'batch_year' => 2023,
                'latitude' => $initialLat,
                'longitude' => $initialLng,
                'email_verified_at' => now(),
            ]);
            
            // Get initial locations
            $initialLocations = $mapService->getMemberLocations();
            
            // Verify initial coordinates are in the map
            $this->assertCount(1, $initialLocations);
            $this->assertEqualsWithDelta((float) $initialLat, $initialLocations[0]['latitude'], 0.00000001);
            $this->assertEqualsWithDelta((float) $initialLng, $initialLocations[0]['longitude'], 0.00000001);
            
            // Update the member's coordinates
            $member->update([
                'latitude' => $updatedLat,
                'longitude' => $updatedLng,
            ]);
            
            // Get updated locations
            $updatedLocations = $mapService->getMemberLocations();
            
            // Verify the updated coordinates are now in the map
            $this->assertCount(1, $updatedLocations);
            $this->assertEqualsWithDelta(
                (float) $updatedLat,
                $updatedLocations[0]['latitude'],
                0.00000001,
                "Updated latitude should be reflected in map data"
            );
            $this->assertEqualsWithDelta(
                (float) $updatedLng,
                $updatedLocations[0]['longitude'],
                0.00000001,
                "Updated longitude should be reflected in map data"
            );
            
            // Verify the member ID is still the same
            $this->assertEquals($member->id, $updatedLocations[0]['id']);
        });
    }
}
