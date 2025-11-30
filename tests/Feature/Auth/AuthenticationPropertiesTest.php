<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthenticationPropertiesTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * **Feature: manaahel-platform, Property 35: User registration creates account with default role**
     * 
     * For any valid registration with email and password, a new user account should be created with role set to 'user'.
     * 
     * @test
     */
    #[Test]
    public function user_registration_creates_account_with_default_role()
    {
        $this->forAll(
            Generator\int()
        )
        ->withMaxSize(100)
        ->then(function ($randomNumber) {
            // Generate unique email for this test iteration using microtime for uniqueness
            $uniqueEmail = 'test' . microtime(true) . $randomNumber . '@example.com';
            $validName = 'Test User ' . $randomNumber;
            $validPassword = 'Password123!'; // Ensure password meets requirements
            
            $response = $this->post('/register', [
                'name' => $validName,
                'email' => $uniqueEmail,
                'password' => $validPassword,
                'password_confirmation' => $validPassword,
            ]);

            // Ensure registration was successful (redirects to dashboard)
            $response->assertRedirect('/dashboard');

            // Verify user is authenticated (which means registration succeeded)
            $this->assertAuthenticated();
            
            // Get the authenticated user and verify role is set to 'user'
            $user = auth()->user();
            $this->assertNotNull($user, "Authenticated user should exist");
            $this->assertEquals('user', $user->role, "User role should be 'user'");
        });
    }

    /**
     * **Feature: manaahel-platform, Property 37: Email verification marks account**
     * 
     * For any verification link clicked, the user's email_verified_at field should be set and login should be allowed.
     * 
     * @test
     */
    #[Test]
    public function email_verification_marks_account()
    {
        $this->forAll(
            Generator\string()
        )
        ->withMaxSize(100)
        ->then(function ($name) {
            // Create an unverified user
            $uniqueEmail = 'test' . uniqid() . '@example.com';
            $user = User::factory()->unverified()->create([
                'name' => $name ?: 'Test User',
                'email' => $uniqueEmail,
            ]);

            // Verify that email_verified_at is null initially
            $this->assertNull($user->email_verified_at);

            // Simulate email verification
            $user->markEmailAsVerified();

            // Refresh the user from database
            $user->refresh();

            // Verify that email_verified_at is now set
            $this->assertNotNull($user->email_verified_at);
            $this->assertTrue($user->hasVerifiedEmail());
        });
    }

    /**
     * **Feature: manaahel-platform, Property 38: Valid login creates session**
     * 
     * For any valid login credentials submitted, the system should authenticate the user and create an active session.
     * 
     * @test
     */
    #[Test]
    public function valid_login_creates_session()
    {
        $this->forAll(
            Generator\string()
        )
        ->withMaxSize(100)
        ->then(function ($randomSeed) {
            // Clean up any existing users and logout
            User::query()->delete();
            auth()->logout();
            
            // Create a verified user with known password
            $uniqueEmail = 'test' . uniqid() . '@example.com';
            $password = 'Password123!';
            
            $user = User::factory()->create([
                'email' => $uniqueEmail,
                'password' => Hash::make($password),
            ]);

            // Attempt to login
            $response = $this->post('/login', [
                'email' => $uniqueEmail,
                'password' => $password,
            ]);

            // Verify user is authenticated
            $this->assertAuthenticatedAs($user);
        });
    }

    /**
     * **Feature: manaahel-platform, Property 39: Invalid login rejection**
     * 
     * For any invalid login credentials submitted, the system should reject the attempt and display an error message.
     * 
     * @test
     */
    #[Test]
    public function invalid_login_rejection()
    {
        $this->forAll(
            Generator\string()
        )
        ->withMaxSize(100)
        ->then(function ($randomSeed) {
            // Create a user with a known password
            $uniqueEmail = 'test' . uniqid() . '@example.com';
            $correctPassword = 'CorrectPassword123!';
            $wrongPassword = 'WrongPassword456!';
            
            $user = User::factory()->create([
                'email' => $uniqueEmail,
                'password' => Hash::make($correctPassword),
            ]);

            // Attempt to login with wrong password
            $response = $this->post('/login', [
                'email' => $uniqueEmail,
                'password' => $wrongPassword,
            ]);

            // Verify user is not authenticated
            $this->assertGuest();
            
            // Verify error message is present
            $response->assertSessionHasErrors('email');
        });
    }
}
