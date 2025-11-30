<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $newEmail = 'updated-' . $user->id . '@example.com';

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $newEmail,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame($newEmail, $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }

    public function test_profile_can_be_updated_with_new_fields(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Updated Name',
                'email' => $user->email,
                'batch_year' => 2023,
                'latitude' => -6.2088,
                'longitude' => 106.8456,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Updated Name', $user->name);
        $this->assertEquals(2023, $user->batch_year);
        $this->assertEquals(-6.2088, (float) $user->latitude);
        $this->assertEquals(106.8456, (float) $user->longitude);
    }

    public function test_latitude_validation_rejects_invalid_values(): void
    {
        $user = User::factory()->create();

        // Test latitude > 90
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 91,
                'longitude' => 0,
            ]);

        $response->assertSessionHasErrors(['latitude']);

        // Test latitude < -90
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => -91,
                'longitude' => 0,
            ]);

        $response->assertSessionHasErrors(['latitude']);
    }

    public function test_longitude_validation_rejects_invalid_values(): void
    {
        $user = User::factory()->create();

        // Test longitude > 180
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 0,
                'longitude' => 181,
            ]);

        $response->assertSessionHasErrors(['longitude']);

        // Test longitude < -180
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 0,
                'longitude' => -181,
            ]);

        $response->assertSessionHasErrors(['longitude']);
    }

    public function test_coordinate_validation_rejects_non_numeric_values(): void
    {
        $user = User::factory()->create();

        // Test non-numeric latitude
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 'not-a-number',
                'longitude' => 0,
            ]);

        $response->assertSessionHasErrors(['latitude']);

        // Test non-numeric longitude
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 0,
                'longitude' => 'invalid',
            ]);

        $response->assertSessionHasErrors(['longitude']);
    }

    public function test_coordinate_validation_accepts_valid_decimal_values(): void
    {
        $user = User::factory()->create();

        // Test valid decimal coordinates
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 45.5231,
                'longitude' => -122.6765,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertEquals(45.5231, (float) $user->latitude);
        $this->assertEquals(-122.6765, (float) $user->longitude);
    }

    public function test_coordinate_validation_accepts_boundary_values(): void
    {
        $user = User::factory()->create();

        // Test boundary values (exactly -90, 90, -180, 180)
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => 90,
                'longitude' => 180,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertEquals(90, (float) $user->latitude);
        $this->assertEquals(180, (float) $user->longitude);

        // Test negative boundary values
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => $user->name,
                'email' => $user->email,
                'latitude' => -90,
                'longitude' => -180,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertEquals(-90, (float) $user->latitude);
        $this->assertEquals(-180, (float) $user->longitude);
    }
}
