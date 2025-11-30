<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegistrationPolicyPropertiesTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * **Feature: manaahel-platform, Property 14: Only admins can change registration status**
     * 
     * For any user without admin role, attempts to change registration status should be rejected.
     * 
     * **Validates: Requirements 4.4**
     */
    #[Test]
    public function only_admins_can_change_registration_status()
    {
        $this->forAll(
            Generator\elements('user', 'member', 'admin'),
            Generator\elements('pending', 'approved', 'rejected')
        )
        ->withMaxSize(100)
        ->then(function ($userRole, $initialStatus) {
            // Create a program with unique slug
            $uniqueSlug = 'test-program-' . uniqid();
            $program = Program::factory()->create([
                'name' => ['id' => 'Test Program', 'en' => 'Test Program', 'ar' => 'برنامج اختبار'],
                'slug' => $uniqueSlug,
                'type' => 'academy',
                'status' => true,
            ]);

            // Create a user with the specified role
            $user = User::factory()->create([
                'role' => $userRole,
            ]);

            // Create another user who made the registration
            $registrant = User::factory()->create([
                'role' => 'user',
            ]);

            // Create a registration
            $registration = Registration::factory()->create([
                'user_id' => $registrant->id,
                'program_id' => $program->id,
                'status' => $initialStatus,
                'payment_proof' => 'proof.jpg',
            ]);

            // Act as the user and check if they can update the registration
            $this->actingAs($user);
            
            $canUpdate = Gate::forUser($user)->allows('update', $registration);

            // Assert: only admins should be able to update
            if ($userRole === 'admin') {
                $this->assertTrue($canUpdate, "Admin should be able to update registration status");
            } else {
                $this->assertFalse($canUpdate, "Non-admin user with role '{$userRole}' should not be able to update registration status");
            }
        });
    }
}
