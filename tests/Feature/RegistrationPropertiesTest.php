<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegistrationPropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 7: Valid registration creates pending record**
     * 
     * For any valid registration data submitted by an authenticated user, 
     * the system should create a registration record with status set to pending.
     * 
     * **Validates: Requirements 3.1**
     */
    #[Test]
    public function valid_registration_creates_pending_record()
    {
        Storage::fake('private');

        $this->forAll(
            Generator\choose(1, 5), // Number of registrations to create
            Generator\elements('academy', 'competition')
        )
        ->withMaxSize(100)
        ->then(function ($count, $programType) {
            for ($i = 0; $i < $count; $i++) {
                // Create a user
                $user = User::factory()->create();
                
                // Create an active program
                $program = Program::create([
                    'name' => ['en' => "Program {$i}", 'id' => "Program {$i}", 'ar' => "برنامج {$i}"],
                    'slug' => 'program-' . uniqid(),
                    'type' => $programType,
                    'status' => true,
                    'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                    'fees' => 1000000,
                    'start_date' => now()->addDays(30)->format('Y-m-d'),
                ]);
                
                // Create a fake file
                $file = UploadedFile::fake()->image('payment.jpg');
                
                // Act as the user and submit registration
                $response = $this->actingAs($user)->post(route('registrations.store'), [
                    'program_id' => $program->id,
                    'payment_proof' => $file,
                ]);
                
                // Verify registration was created
                $registration = Registration::where('user_id', $user->id)
                    ->where('program_id', $program->id)
                    ->first();
                
                $this->assertNotNull($registration, 'Registration should be created');
                
                // Verify status is pending
                $this->assertEquals('pending', $registration->status, 
                    'Registration status should be pending');
                
                // Verify user_id and program_id are correct
                $this->assertEquals($user->id, $registration->user_id);
                $this->assertEquals($program->id, $registration->program_id);
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 8: Payment proof storage and association**
     * 
     * For any registration with uploaded payment proof file, the file should 
     * be stored and the file path should be associated with the registration record.
     * 
     * **Validates: Requirements 3.2**
     */
    #[Test]
    public function payment_proof_is_stored_and_associated()
    {
        Storage::fake('private');

        $this->forAll(
            Generator\elements('jpg', 'png', 'pdf'),
            Generator\choose(100, 1000) // File size in KB
        )
        ->withMaxSize(100)
        ->then(function ($extension, $sizeKb) {
            // Create a user and program
            $user = User::factory()->create();
            $program = Program::create([
                'name' => ['en' => 'Test Program', 'id' => 'Program Tes', 'ar' => 'برنامج اختبار'],
                'slug' => 'program-' . uniqid(),
                'type' => 'academy',
                'status' => true,
                'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                'fees' => 1000000,
                'start_date' => now()->addDays(30)->format('Y-m-d'),
            ]);
            
            // Create a fake file with specific extension
            $file = $extension === 'pdf' 
                ? UploadedFile::fake()->create('payment.pdf', $sizeKb, 'application/pdf')
                : UploadedFile::fake()->image("payment.{$extension}", 800, 600)->size($sizeKb);
            
            // Submit registration
            $response = $this->actingAs($user)->post(route('registrations.store'), [
                'program_id' => $program->id,
                'payment_proof' => $file,
            ]);
            
            // Get the created registration
            $registration = Registration::where('user_id', $user->id)
                ->where('program_id', $program->id)
                ->first();
            
            $this->assertNotNull($registration, 'Registration should be created');
            
            // Verify payment_proof path is stored
            $this->assertNotNull($registration->payment_proof, 
                'Payment proof path should be stored in registration');
            
            // Verify the file exists in storage
            Storage::disk('private')->assertExists($registration->payment_proof);
            
            // Verify the path starts with expected directory
            $this->assertStringStartsWith('payment-proofs/', $registration->payment_proof,
                'Payment proof should be stored in payment-proofs directory');
        });
    }

    /**
     * **Feature: manaahel-platform, Property 9: Invalid registration rejection**
     * 
     * For any registration submission missing required fields, the system 
     * should prevent creation and return validation errors.
     * 
     * **Validates: Requirements 3.3**
     */
    #[Test]
    public function invalid_registration_is_rejected()
    {
        Storage::fake('private');

        $this->forAll(
            Generator\bool(), // Whether to include program_id
            Generator\bool()  // Whether to include payment_proof
        )
        ->when(function ($hasProgram, $hasFile) {
            // Only test cases where at least one field is missing
            return !$hasProgram || !$hasFile;
        })
        ->withMaxSize(100)
        ->then(function ($hasProgram, $hasFile) {
            // Create a user and program
            $user = User::factory()->create();
            $program = Program::create([
                'name' => ['en' => 'Test Program', 'id' => 'Program Tes', 'ar' => 'برنامج اختبار'],
                'slug' => 'program-' . uniqid(),
                'type' => 'academy',
                'status' => true,
                'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                'fees' => 1000000,
                'start_date' => now()->addDays(30)->format('Y-m-d'),
            ]);
            
            // Build request data with missing fields
            $data = [];
            if ($hasProgram) {
                $data['program_id'] = $program->id;
            }
            if ($hasFile) {
                $data['payment_proof'] = UploadedFile::fake()->image('payment.jpg');
            }
            
            // Count registrations before
            $countBefore = Registration::count();
            
            // Submit registration with missing fields
            $response = $this->actingAs($user)->post(route('registrations.store'), $data);
            
            // Verify validation errors occurred (session has errors)
            $response->assertSessionHasErrors();
            
            // Verify no registration was created
            $countAfter = Registration::count();
            $this->assertEquals($countBefore, $countAfter, 
                'No registration should be created when required fields are missing');
        });
    }

    /**
     * **Feature: manaahel-platform, Property 10: Authentication required for registration**
     * 
     * For any registration submission attempt by an unauthenticated user, 
     * the system should reject the submission.
     * 
     * **Validates: Requirements 3.5**
     */
    #[Test]
    public function unauthenticated_user_cannot_register()
    {
        Storage::fake('private');

        $this->forAll(
            Generator\elements('academy', 'competition')
        )
        ->withMaxSize(100)
        ->then(function ($programType) {
            // Create a program
            $program = Program::create([
                'name' => ['en' => 'Test Program', 'id' => 'Program Tes', 'ar' => 'برنامج اختبار'],
                'slug' => 'program-' . uniqid(),
                'type' => $programType,
                'status' => true,
                'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                'fees' => 1000000,
                'start_date' => now()->addDays(30)->format('Y-m-d'),
            ]);
            
            // Create a fake file
            $file = UploadedFile::fake()->image('payment.jpg');
            
            // Count registrations before
            $countBefore = Registration::count();
            
            // Try to submit registration without authentication
            $response = $this->post(route('registrations.store'), [
                'program_id' => $program->id,
                'payment_proof' => $file,
            ]);
            
            // Verify the request was rejected (redirected to login or 403)
            $this->assertTrue(
                $response->status() === 302 || $response->status() === 403,
                'Unauthenticated request should be rejected with redirect or 403'
            );
            
            // Verify no registration was created
            $countAfter = Registration::count();
            $this->assertEquals($countBefore, $countAfter, 
                'No registration should be created for unauthenticated users');
            
            // Also test the create route
            $createResponse = $this->get(route('registrations.create', ['program' => $program->id]));
            $this->assertTrue(
                $createResponse->status() === 302 || $createResponse->status() === 403,
                'Unauthenticated access to registration form should be rejected'
            );
        });
    }
}
