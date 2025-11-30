<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminRegistrationPropertiesTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * **Feature: manaahel-platform, Property 12: Admin approval updates status**
     * 
     * For any pending registration, when an admin approves it, 
     * the registration status should be updated to approved.
     * 
     * **Validates: Requirements 4.2**
     */
    #[Test]
    public function admin_approval_updates_status()
    {
        $this->forAll(
            Generator\choose(1, 5) // Number of registrations to test
        )
        ->withMaxSize(100)
        ->then(function ($count) {
            for ($i = 0; $i < $count; $i++) {
                // Create an admin user
                $admin = User::factory()->create([
                    'role' => 'admin',
                ]);

                // Create a program with unique slug
                $uniqueSlug = 'test-program-' . uniqid();
                $program = Program::factory()->create([
                    'name' => ['id' => "Program {$i}", 'en' => "Program {$i}", 'ar' => "برنامج {$i}"],
                    'slug' => $uniqueSlug,
                    'type' => 'academy',
                    'status' => true,
                ]);

                // Create a user who made the registration
                $registrant = User::factory()->create([
                    'role' => 'user',
                ]);

                // Create a pending registration
                $registration = Registration::factory()->create([
                    'user_id' => $registrant->id,
                    'program_id' => $program->id,
                    'status' => 'pending',
                    'payment_proof' => 'payment-proofs/proof.jpg',
                ]);

                // Verify initial status is pending
                $this->assertEquals('pending', $registration->status, 
                    'Initial registration status should be pending');

                // Admin approves the registration
                $result = $registration->approve();

                // Verify the approve method returns true
                $this->assertTrue($result, 
                    'The approve() method should return true');

                // Verify the status is updated to approved
                $this->assertEquals('approved', $registration->status, 
                    'Registration status should be updated to approved');

                // Verify the status is persisted in the database
                $registration->refresh();
                $this->assertEquals('approved', $registration->status, 
                    'Registration status should be persisted as approved in database');
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 13: Admin rejection updates status**
     * 
     * For any pending registration, when an admin rejects it, 
     * the registration status should be updated to rejected.
     * 
     * **Validates: Requirements 4.3**
     */
    #[Test]
    public function admin_rejection_updates_status()
    {
        $this->forAll(
            Generator\choose(1, 5) // Number of registrations to test
        )
        ->withMaxSize(100)
        ->then(function ($count) {
            for ($i = 0; $i < $count; $i++) {
                // Create an admin user
                $admin = User::factory()->create([
                    'role' => 'admin',
                ]);

                // Create a program with unique slug
                $uniqueSlug = 'test-program-' . uniqid();
                $program = Program::factory()->create([
                    'name' => ['id' => "Program {$i}", 'en' => "Program {$i}", 'ar' => "برنامج {$i}"],
                    'slug' => $uniqueSlug,
                    'type' => 'competition',
                    'status' => true,
                ]);

                // Create a user who made the registration
                $registrant = User::factory()->create([
                    'role' => 'user',
                ]);

                // Create a pending registration
                $registration = Registration::factory()->create([
                    'user_id' => $registrant->id,
                    'program_id' => $program->id,
                    'status' => 'pending',
                    'payment_proof' => 'payment-proofs/proof.jpg',
                ]);

                // Verify initial status is pending
                $this->assertEquals('pending', $registration->status, 
                    'Initial registration status should be pending');

                // Admin rejects the registration
                $result = $registration->reject();

                // Verify the reject method returns true
                $this->assertTrue($result, 
                    'The reject() method should return true');

                // Verify the status is updated to rejected
                $this->assertEquals('rejected', $registration->status, 
                    'Registration status should be updated to rejected');

                // Verify the status is persisted in the database
                $registration->refresh();
                $this->assertEquals('rejected', $registration->status, 
                    'Registration status should be persisted as rejected in database');
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 15: Status change persistence**
     * 
     * For any registration status change, immediately querying the database 
     * should return the new status.
     * 
     * **Validates: Requirements 4.5**
     */
    #[Test]
    public function status_change_is_persisted()
    {
        $this->forAll(
            Generator\elements('approved', 'rejected'), // New status
            Generator\choose(1, 3) // Number of registrations to test
        )
        ->withMaxSize(100)
        ->then(function ($newStatus, $count) {
            for ($i = 0; $i < $count; $i++) {
                // Create a program with unique slug
                $uniqueSlug = 'test-program-' . uniqid();
                $program = Program::factory()->create([
                    'name' => ['id' => "Program {$i}", 'en' => "Program {$i}", 'ar' => "برنامج {$i}"],
                    'slug' => $uniqueSlug,
                    'type' => 'academy',
                    'status' => true,
                ]);

                // Create a user who made the registration
                $registrant = User::factory()->create([
                    'role' => 'user',
                ]);

                // Create a pending registration
                $registration = Registration::factory()->create([
                    'user_id' => $registrant->id,
                    'program_id' => $program->id,
                    'status' => 'pending',
                    'payment_proof' => 'payment-proofs/proof.jpg',
                ]);

                // Change the status based on the generated value
                if ($newStatus === 'approved') {
                    $registration->approve();
                } else {
                    $registration->reject();
                }

                // Immediately query the database to verify persistence
                $freshRegistration = Registration::find($registration->id);
                
                $this->assertNotNull($freshRegistration, 
                    'Registration should exist in database');
                
                $this->assertEquals($newStatus, $freshRegistration->status, 
                    "Registration status should be persisted as {$newStatus} in database");

                // Also verify using fresh() method
                $registration->refresh();
                $this->assertEquals($newStatus, $registration->status, 
                    "Registration status should be {$newStatus} after refresh");
            }
        });
    }
}
