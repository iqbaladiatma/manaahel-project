<?php

namespace Tests\Feature;

use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfilePropertiesTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * **Feature: manaahel-platform, Property 40: Profile update persistence**
     * 
     * For any profile update by a member, immediately querying the database 
     * should return the updated values.
     * 
     * **Validates: Requirements 11.1**
     * 
     * @test
     */
    #[Test]
    public function profile_update_persistence()
    {
        $this->forAll(
            Generator\string(), // name seed
            Generator\choose(1900, (int)date('Y') + 10), // batch_year
            Generator\float(-90.0, 90.0), // latitude
            Generator\float(-180.0, 180.0) // longitude
        )
            ->withMaxSize(100) // Run 100 iterations
            ->then(function ($nameSeed, $batchYear, $latitude, $longitude) {
                // Clear users before each iteration
                User::query()->delete();
                
                // Generate a valid name (ensure it's not empty and within limits)
                $name = $nameSeed ?: 'Test User';
                if (strlen($name) > 255) {
                    $name = substr($name, 0, 255);
                }
                
                // Create a user
                $user = User::factory()->create([
                    'role' => 'user',
                    'email' => 'test_' . uniqid() . '@example.com',
                ]);

                // Update the profile
                $response = $this
                    ->actingAs($user)
                    ->patch('/profile', [
                        'name' => $name,
                        'email' => $user->email,
                        'batch_year' => $batchYear,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ]);

                // Assert no errors
                $response->assertSessionHasNoErrors();

                // Immediately query the database
                $updatedUser = User::find($user->id);

                // Assert all values are persisted correctly
                $this->assertSame($name, $updatedUser->name);
                $this->assertEquals($batchYear, $updatedUser->batch_year);
                
                // For decimal values, we need to compare with tolerance
                $this->assertEqualsWithDelta(
                    $latitude, 
                    (float) $updatedUser->latitude, 
                    0.00000001,
                    "Latitude should be persisted correctly"
                );
                
                $this->assertEqualsWithDelta(
                    $longitude, 
                    (float) $updatedUser->longitude, 
                    0.00000001,
                    "Longitude should be persisted correctly"
                );
            });
    }

    /**
     * **Feature: manaahel-platform, Property 41: Coordinate validation**
     * 
     * For any latitude or longitude value that is not a valid decimal number,
     * the system should reject the profile update with validation error.
     * 
     * **Validates: Requirements 11.2**
     * 
     * @test
     */
    #[Test]
    public function coordinate_validation()
    {
        // Test invalid latitude values - below minimum
        $this->forAll(
            Generator\choose(-1000, -91)
        )
            ->withMaxSize(25) // Run 25 iterations for latitude below minimum
            ->then(function ($invalidLatitude) {
                // Clear users before each iteration
                User::query()->delete();
                
                // Create a user
                $user = User::factory()->create([
                    'role' => 'user',
                    'email' => 'test_' . uniqid() . '@example.com',
                ]);

                // Test invalid latitude
                $response = $this
                    ->actingAs($user)
                    ->patch('/profile', [
                        'name' => $user->name,
                        'email' => $user->email,
                        'latitude' => $invalidLatitude,
                        'longitude' => 0, // Valid longitude
                    ]);

                // Assert validation error for latitude
                $response->assertSessionHasErrors(['latitude']);

                // Verify the user's coordinates were NOT updated
                $unchangedUser = User::find($user->id);
                $this->assertEquals($user->latitude, $unchangedUser->latitude);
                $this->assertEquals($user->longitude, $unchangedUser->longitude);
            });

        // Test invalid latitude values - above maximum
        $this->forAll(
            Generator\choose(91, 1000)
        )
            ->withMaxSize(25) // Run 25 iterations for latitude above maximum
            ->then(function ($invalidLatitude) {
                // Clear users before each iteration
                User::query()->delete();
                
                // Create a user
                $user = User::factory()->create([
                    'role' => 'user',
                    'email' => 'test_' . uniqid() . '@example.com',
                ]);

                // Test invalid latitude
                $response = $this
                    ->actingAs($user)
                    ->patch('/profile', [
                        'name' => $user->name,
                        'email' => $user->email,
                        'latitude' => $invalidLatitude,
                        'longitude' => 0, // Valid longitude
                    ]);

                // Assert validation error for latitude
                $response->assertSessionHasErrors(['latitude']);

                // Verify the user's coordinates were NOT updated
                $unchangedUser = User::find($user->id);
                $this->assertEquals($user->latitude, $unchangedUser->latitude);
                $this->assertEquals($user->longitude, $unchangedUser->longitude);
            });

        // Test invalid longitude values - below minimum
        $this->forAll(
            Generator\choose(-1000, -181)
        )
            ->withMaxSize(25) // Run 25 iterations for longitude below minimum
            ->then(function ($invalidLongitude) {
                // Clear users before each iteration
                User::query()->delete();
                
                // Create a user
                $user = User::factory()->create([
                    'role' => 'user',
                    'email' => 'test_' . uniqid() . '@example.com',
                ]);

                // Test invalid longitude
                $response = $this
                    ->actingAs($user)
                    ->patch('/profile', [
                        'name' => $user->name,
                        'email' => $user->email,
                        'latitude' => 0, // Valid latitude
                        'longitude' => $invalidLongitude,
                    ]);

                // Assert validation error for longitude
                $response->assertSessionHasErrors(['longitude']);

                // Verify the user's coordinates were NOT updated
                $unchangedUser = User::find($user->id);
                $this->assertEquals($user->latitude, $unchangedUser->latitude);
                $this->assertEquals($user->longitude, $unchangedUser->longitude);
            });

        // Test invalid longitude values - above maximum
        $this->forAll(
            Generator\choose(181, 1000)
        )
            ->withMaxSize(25) // Run 25 iterations for longitude above maximum
            ->then(function ($invalidLongitude) {
                // Clear users before each iteration
                User::query()->delete();
                
                // Create a user
                $user = User::factory()->create([
                    'role' => 'user',
                    'email' => 'test_' . uniqid() . '@example.com',
                ]);

                // Test invalid longitude
                $response = $this
                    ->actingAs($user)
                    ->patch('/profile', [
                        'name' => $user->name,
                        'email' => $user->email,
                        'latitude' => 0, // Valid latitude
                        'longitude' => $invalidLongitude,
                    ]);

                // Assert validation error for longitude
                $response->assertSessionHasErrors(['longitude']);

                // Verify the user's coordinates were NOT updated
                $unchangedUser = User::find($user->id);
                $this->assertEquals($user->latitude, $unchangedUser->latitude);
                $this->assertEquals($user->longitude, $unchangedUser->longitude);
            });
    }

    /**
     * **Feature: manaahel-platform, Property 43: Profile update authorization**
     * 
     * For any member, attempts to update another user's profile should be rejected.
     * 
     * **Validates: Requirements 11.5**
     * 
     * @test
     */
    #[Test]
    public function profile_update_authorization()
    {
        $this->forAll(
            Generator\string(), // name for target user
            Generator\choose(1900, (int)date('Y') + 10), // batch_year
            Generator\float(-90.0, 90.0), // latitude
            Generator\float(-180.0, 180.0) // longitude
        )
            ->withMaxSize(100) // Run 100 iterations
            ->then(function ($nameSeed, $batchYear, $latitude, $longitude) {
                // Clear users before each iteration
                User::query()->delete();
                
                // Generate a valid name (ensure it's not empty and within limits)
                $name = $nameSeed ?: 'Target User';
                if (strlen($name) > 255) {
                    $name = substr($name, 0, 255);
                }
                
                // Create two different users
                $authenticatedUser = User::factory()->create([
                    'role' => 'user',
                    'email' => 'authenticated_' . uniqid() . '@example.com',
                    'name' => 'Authenticated User',
                ]);

                $targetUser = User::factory()->create([
                    'role' => 'user',
                    'email' => 'target_' . uniqid() . '@example.com',
                    'name' => 'Original Target Name',
                    'batch_year' => 2020,
                    'latitude' => 0.0,
                    'longitude' => 0.0,
                ]);

                // Store original values
                $originalName = $targetUser->name;
                $originalBatchYear = $targetUser->batch_year;
                $originalLatitude = $targetUser->latitude;
                $originalLongitude = $targetUser->longitude;

                // Attempt to update target user's profile while authenticated as a different user
                // We need to manually construct the route since we're trying to update another user
                $response = $this
                    ->actingAs($authenticatedUser)
                    ->patch('/profile', [
                        'name' => $name,
                        'email' => $targetUser->email,
                        'batch_year' => $batchYear,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ]);

                // The system should reject this attempt
                // Since the ProfileController checks if the authenticated user is updating their own profile,
                // and we're sending a different email, this should either:
                // 1. Update the authenticated user's profile (not the target user's)
                // 2. Fail validation because the email already exists
                
                // Verify the target user's profile was NOT updated
                $unchangedTargetUser = User::find($targetUser->id);
                
                $this->assertSame($originalName, $unchangedTargetUser->name);
                $this->assertEquals($originalBatchYear, $unchangedTargetUser->batch_year);
                $this->assertEquals($originalLatitude, (float) $unchangedTargetUser->latitude);
                $this->assertEquals($originalLongitude, (float) $unchangedTargetUser->longitude);
            });
    }
}
