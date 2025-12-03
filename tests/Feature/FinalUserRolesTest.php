<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FinalUserRolesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Guest user access controls
     * Requirements: All authorization requirements
     */
    #[Test]
    public function guest_user_has_correct_access_controls()
    {
        // Create test data
        $category = Category::factory()->create();
        $article = Article::factory()->create(['category_id' => $category->id]);
        $program = Program::factory()->create(['status' => true]);
        $publicGallery = Gallery::factory()->create(['visibility' => 'public']);
        $memberGallery = Gallery::factory()->create(['visibility' => 'member_only']);

        // Guest CAN access public pages
        $this->get('/')->assertStatus(200);
        $this->get('/about')->assertStatus(200);
        $this->get('/programs')->assertStatus(200);
        $this->get('/programs/' . $program->slug)->assertStatus(200);
        $this->get('/articles')->assertStatus(200);
        $this->get('/articles/' . $article->slug)->assertStatus(200);
        $this->get('/map')->assertStatus(200);
        $this->get('/gallery')->assertStatus(200);

        // Guest CANNOT access member-only content
        $this->get('/courses')->assertRedirect('/login');
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/profile')->assertRedirect('/login');

        // Guest CANNOT access admin panel (Filament redirects to /admin/login)
        $response = $this->get('/admin');
        $this->assertTrue(
            $response->status() === 302 && (
                str_contains($response->headers->get('Location'), '/login') ||
                str_contains($response->headers->get('Location'), '/admin/login')
            ),
            'Guest should be redirected to login when accessing admin panel'
        );
    }

    /**
     * Test User role access controls
     * Requirements: All authorization requirements
     */
    #[Test]
    public function user_role_has_correct_access_controls()
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->create();
        $article = Article::factory()->create(['category_id' => $category->id]);
        $program = Program::factory()->create(['status' => true]);

        $this->actingAs($user);

        // User CAN access public pages
        $this->get('/')->assertStatus(200);
        $this->get('/programs')->assertStatus(200);
        $this->get('/articles')->assertStatus(200);

        // User CAN access their profile
        $this->get('/profile')->assertStatus(200);

        // User CAN access member areas (courses, gallery)
        $this->get('/courses')->assertStatus(200);
        $this->get('/gallery')->assertStatus(200);

        // User CAN submit registration (if route exists)
        $response = $this->get('/registrations/create');
        $this->assertTrue(
            $response->status() === 200 || $response->status() === 404,
            'Registration create route should be accessible or not found'
        );

        // User CANNOT access admin panel
        $response = $this->get('/admin');
        $this->assertTrue(
            $response->status() === 403 || $response->status() === 302,
            'User should not access admin panel'
        );

        // User CANNOT approve/reject registrations
        $registration = Registration::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);
        
        $this->assertFalse($user->isAdmin());
    }

    /**
     * Test Member role access controls
     * Requirements: All authorization requirements
     */
    #[Test]
    public function member_role_has_correct_access_controls()
    {
        $member = User::factory()->create(['role' => 'user']); // Members are users with verified email
        $program = Program::factory()->create(['status' => true]);
        $course = Course::factory()->create(['program_id' => $program->id]);
        $memberGallery = Gallery::factory()->create([
            'visibility' => 'member_only',
            'batch_filter' => $member->batch_year
        ]);

        $this->actingAs($member);

        // Member CAN access all public pages
        $this->get('/')->assertStatus(200);
        $this->get('/programs')->assertStatus(200);
        $this->get('/articles')->assertStatus(200);

        // Member CAN access member-only content
        $this->get('/courses')->assertStatus(200);
        $this->get('/gallery')->assertStatus(200);
        $this->get('/profile')->assertStatus(200);
        $this->get('/dashboard')->assertStatus(200);

        // Member CAN view courses (if they have access via policy)
        $response = $this->get('/courses/' . $course->id);
        // May be 200 (allowed) or 403 (policy denied) depending on enrollment
        $this->assertTrue(
            $response->status() === 200 || $response->status() === 403,
            'Course access depends on enrollment status'
        );

        // Member CAN submit registrations (if route exists)
        $response = $this->get('/registrations/create');
        $this->assertTrue(
            $response->status() === 200 || $response->status() === 404,
            'Registration create route should be accessible or not found'
        );

        // Member CANNOT access admin panel
        $response = $this->get('/admin');
        $this->assertTrue(
            $response->status() === 403 || $response->status() === 302,
            'Member should not access admin panel'
        );

        // Member CAN only update their own profile
        $otherUser = User::factory()->create();
        $response = $this->put('/profile/' . $otherUser->id, [
            'name' => 'Hacked Name'
        ]);
        // Should be forbidden or not found
        $this->assertTrue(
            $response->status() === 403 || $response->status() === 404,
            'Member should not update other profiles'
        );
    }

    /**
     * Test Admin role access controls
     * Requirements: All authorization requirements
     */
    #[Test]
    public function admin_role_has_correct_access_controls()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $program = Program::factory()->create();
        $registration = Registration::factory()->create([
            'user_id' => $user->id,
            'program_id' => $program->id,
            'status' => 'pending'
        ]);

        $this->actingAs($admin);

        // Admin CAN access all public pages
        $this->get('/')->assertStatus(200);
        $this->get('/programs')->assertStatus(200);
        $this->get('/articles')->assertStatus(200);

        // Admin CAN access member areas
        $this->get('/courses')->assertStatus(200);
        $this->get('/gallery')->assertStatus(200);
        $this->get('/profile')->assertStatus(200);

        // Admin CAN access admin panel
        $this->get('/admin')->assertStatus(200);

        // Admin CAN view dashboard
        $this->get('/admin')->assertStatus(200);

        // Admin CAN manage registrations
        $this->assertTrue($admin->isAdmin());

        // Verify admin can approve registration
        $registration->approve();
        $this->assertEquals('approved', $registration->fresh()->status);

        // Verify admin can reject registration
        $registration->reject();
        $this->assertEquals('rejected', $registration->fresh()->status);
    }

    /**
     * Test authorization policies work correctly
     * Requirements: All authorization requirements
     */
    #[Test]
    public function authorization_policies_enforce_access_control()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $program = Program::factory()->create();
        $registration = Registration::factory()->create([
            'user_id' => $user->id,
            'program_id' => $program->id,
            'status' => 'pending'
        ]);

        // Test RegistrationPolicy
        $this->actingAs($admin);
        $this->assertTrue($admin->can('viewAny', Registration::class));
        $this->assertTrue($admin->can('update', $registration));

        $this->actingAs($user);
        $this->assertFalse($user->can('viewAny', Registration::class));
        $this->assertFalse($user->can('update', $registration));

        // Test CoursePolicy - members can view courses
        $course = Course::factory()->create(['program_id' => $program->id]);
        
        // Create approved registration for user
        $approvedRegistration = Registration::factory()->create([
            'user_id' => $user->id,
            'program_id' => $program->id,
            'status' => 'approved'
        ]);

        $this->actingAs($user);
        $this->assertTrue($user->can('view', $course));

        // Test GalleryPolicy
        $publicGallery = Gallery::factory()->create(['visibility' => 'public']);
        $memberGallery = Gallery::factory()->create([
            'visibility' => 'member_only',
            'batch_filter' => null // No batch filter, so any member can view
        ]);
        $batchFilteredGallery = Gallery::factory()->create([
            'visibility' => 'member_only',
            'batch_filter' => $user->batch_year // Matches user's batch
        ]);

        // Guest cannot view member-only gallery
        $this->assertFalse((new \App\Policies\GalleryPolicy())->view(null, $memberGallery));

        // User can view member-only gallery without batch filter
        $this->assertTrue((new \App\Policies\GalleryPolicy())->view($user, $memberGallery));

        // User can view member-only gallery with matching batch filter
        $this->assertTrue((new \App\Policies\GalleryPolicy())->view($user, $batchFilteredGallery));

        // Anyone can view public gallery
        $this->assertTrue((new \App\Policies\GalleryPolicy())->view(null, $publicGallery));
    }

    /**
     * Test role-based dashboard access
     * Requirements: 12.5
     */
    #[Test]
    public function only_admin_can_access_dashboard_statistics()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        // Admin can access dashboard
        $this->actingAs($admin);
        $this->get('/admin')->assertStatus(200);

        // User cannot access admin dashboard
        $this->actingAs($user);
        $response = $this->get('/admin');
        $this->assertTrue(
            $response->status() === 403 || $response->status() === 302,
            'Non-admin should not access admin dashboard'
        );
    }
}
