<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CoursePropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 26: Member sees available courses**
     * 
     * For any member, the e-learning section should display only courses 
     * that are available to them based on their enrollments.
     * 
     * **Validates: Requirements 8.1**
     */
    #[Test]
    public function member_sees_only_available_courses()
    {
        $this->forAll(
            Generator\choose(2, 4), // Number of programs
            Generator\choose(1, 2)  // Number of courses per program
        )
        ->withMaxSize(100)
        ->then(function ($programCount, $coursesPerProgram) {
            // Clean database for each iteration
            Course::query()->delete();
            Registration::query()->delete();
            Program::query()->delete();
            User::query()->delete();
            
            // Create a member
            $member = User::factory()->create([
                'role' => 'user',
                'email_verified_at' => now(),
            ]);

            $expectedAvailableCourseIds = [];

            // Create programs and courses
            for ($i = 0; $i < $programCount; $i++) {
                $program = Program::create([
                    'name' => ['en' => "Program {$i}", 'id' => "Program {$i}", 'ar' => "برنامج {$i}"],
                    'slug' => 'program-' . uniqid() . '-' . $i,
                    'type' => 'academy',
                    'status' => true,
                    'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                    'fees' => 1000000,
                    'start_date' => now()->addDays(30)->format('Y-m-d'),
                ]);

                // Enroll member in first half of programs only
                $isEnrolled = $i < ($programCount / 2);
                if ($isEnrolled) {
                    Registration::create([
                        'user_id' => $member->id,
                        'program_id' => $program->id,
                        'status' => 'approved',
                        'payment_proof' => 'proof.jpg',
                    ]);
                }

                // Create courses for this program
                for ($j = 0; $j < $coursesPerProgram; $j++) {
                    $course = Course::create([
                        'title' => ['en' => "Course {$i}-{$j}", 'id' => "Kursus {$i}-{$j}", 'ar' => "دورة {$i}-{$j}"],
                        'program_id' => $program->id,
                        'content' => ['en' => 'Content', 'id' => 'Konten', 'ar' => 'محتوى'],
                        'video_url' => 'https://youtube.com/watch?v=test',
                    ]);
                    
                    if ($isEnrolled) {
                        $expectedAvailableCourseIds[] = $course->id;
                    }
                }
            }

            // Create a course without program association (available to all)
            $generalCourse = Course::create([
                'title' => ['en' => 'General Course', 'id' => 'Kursus Umum', 'ar' => 'دورة عامة'],
                'program_id' => null,
                'content' => ['en' => 'Content', 'id' => 'Konten', 'ar' => 'محتوى'],
                'video_url' => null,
            ]);
            $expectedAvailableCourseIds[] = $generalCourse->id;

            // Get available courses for the member
            $availableCourses = Course::all()->filter(function ($course) use ($member) {
                return $course->isAvailableForMember($member);
            });

            // Verify that only expected courses are available
            $this->assertCount(
                count($expectedAvailableCourseIds), 
                $availableCourses,
                "Expected " . count($expectedAvailableCourseIds) . " courses but got " . $availableCourses->count()
            );
            
            // Verify each available course is in the expected list
            foreach ($availableCourses as $course) {
                $this->assertContains(
                    $course->id,
                    $expectedAvailableCourseIds,
                    "Course {$course->id} should be available to the member"
                );
            }

            // Verify each expected course is in the available list
            foreach ($expectedAvailableCourseIds as $expectedId) {
                $this->assertTrue(
                    $availableCourses->contains('id', $expectedId),
                    "Expected course {$expectedId} should be in available courses"
                );
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 28: Video embedding**
     * 
     * For any course containing a video URL, the course page should render 
     * an embedded video player.
     * 
     * **Validates: Requirements 8.3**
     */
    #[Test]
    public function course_with_video_url_embeds_player()
    {
        $this->forAll(
            Generator\elements(
                'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'https://youtu.be/dQw4w9WgXcQ',
                'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'https://example.com/video.mp4'
            )
        )
        ->withMaxSize(10) // Reduced for faster execution with HTTP requests
        ->then(function ($videoUrl) {
            // Create a member
            $member = User::factory()->create([
                'role' => 'user',
                'email_verified_at' => now(),
            ]);

            // Create a course with video URL
            $course = Course::create([
                'title' => ['en' => 'Video Course', 'id' => 'Kursus Video', 'ar' => 'دورة فيديو'],
                'program_id' => null, // Available to all
                'content' => ['en' => 'Content', 'id' => 'Konten', 'ar' => 'محتوى'],
                'video_url' => $videoUrl,
            ]);

            // Visit the course page as authenticated member
            $response = $this->actingAs($member)->get(route('courses.show', $course));

            // Verify the response is successful
            $response->assertStatus(200);

            // Verify video player is embedded
            if (str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be')) {
                // Should contain YouTube iframe
                $response->assertSee('<iframe', false);
                $response->assertSee('youtube.com/embed/', false);
            } else {
                // Should contain video tag for self-hosted
                $response->assertSee('<video', false);
                $response->assertSee('controls', false);
            }

            // Verify the embed URL is correct
            $embedUrl = $course->getEmbedUrl();
            $this->assertNotNull($embedUrl);
            $response->assertSee($embedUrl, false);
        });
    }

    /**
     * **Feature: manaahel-platform, Property 29: E-learning authentication requirement**
     * 
     * For any unauthenticated user attempting to access e-learning content, 
     * the system should reject the access.
     * 
     * **Validates: Requirements 8.4**
     */
    #[Test]
    public function unauthenticated_users_cannot_access_courses()
    {
        $this->forAll(
            Generator\choose(0, 3) // Number of courses to create
        )
        ->withMaxSize(100)
        ->then(function ($courseCount) {
            $courses = [];
            
            // Create courses
            for ($i = 0; $i < $courseCount; $i++) {
                $courses[] = Course::create([
                    'title' => ['en' => "Course {$i}", 'id' => "Kursus {$i}", 'ar' => "دورة {$i}"],
                    'program_id' => null,
                    'content' => ['en' => 'Content', 'id' => 'Konten', 'ar' => 'محتوى'],
                    'video_url' => null,
                ]);
            }

            // Try to access courses index without authentication
            $indexResponse = $this->get(route('courses.index'));
            
            // Should redirect to login
            $indexResponse->assertRedirect(route('login'));

            // Try to access individual course pages without authentication
            foreach ($courses as $course) {
                $showResponse = $this->get(route('courses.show', $course));
                
                // Should redirect to login
                $showResponse->assertRedirect(route('login'));
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 30: Program-based course access**
     * 
     * For any course associated with a specific program, only members 
     * enrolled in that program should be able to access the course.
     * 
     * **Validates: Requirements 8.5**
     */
    #[Test]
    public function program_courses_require_enrollment()
    {
        $this->forAll(
            Generator\choose(1, 3), // Number of programs
            Generator\elements('pending', 'approved', 'rejected') // Registration status
        )
        ->withMaxSize(100)
        ->then(function ($programCount, $registrationStatus) {
            // Create two members
            $enrolledMember = User::factory()->create([
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
            
            $nonEnrolledMember = User::factory()->create([
                'role' => 'user',
                'email_verified_at' => now(),
            ]);

            // Create programs and courses
            for ($i = 0; $i < $programCount; $i++) {
                $program = Program::create([
                    'name' => ['en' => "Program {$i}", 'id' => "Program {$i}", 'ar' => "برنامج {$i}"],
                    'slug' => 'program-' . uniqid() . '-' . $i,
                    'type' => 'academy',
                    'status' => true,
                    'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                    'fees' => 1000000,
                    'start_date' => now()->addDays(30)->format('Y-m-d'),
                ]);

                // Enroll the first member with the given status
                Registration::create([
                    'user_id' => $enrolledMember->id,
                    'program_id' => $program->id,
                    'status' => $registrationStatus,
                    'payment_proof' => 'proof.jpg',
                ]);

                // Create a course for this program
                $course = Course::create([
                    'title' => ['en' => "Course {$i}", 'id' => "Kursus {$i}", 'ar' => "دورة {$i}"],
                    'program_id' => $program->id,
                    'content' => ['en' => 'Content', 'id' => 'Konten', 'ar' => 'محتوى'],
                    'video_url' => null,
                ]);

                // Check if enrolled member can access (only if approved)
                $canEnrolledAccess = $course->isAvailableForMember($enrolledMember);
                if ($registrationStatus === 'approved') {
                    $this->assertTrue(
                        $canEnrolledAccess,
                        "Member with approved registration should access course {$course->id}"
                    );
                } else {
                    $this->assertFalse(
                        $canEnrolledAccess,
                        "Member with {$registrationStatus} registration should not access course {$course->id}"
                    );
                }

                // Check if non-enrolled member cannot access
                $canNonEnrolledAccess = $course->isAvailableForMember($nonEnrolledMember);
                $this->assertFalse(
                    $canNonEnrolledAccess,
                    "Non-enrolled member should not access course {$course->id}"
                );

                // Test with policy authorization
                if ($registrationStatus === 'approved') {
                    $response = $this->actingAs($enrolledMember)->get(route('courses.show', $course));
                    $response->assertStatus(200);
                } else {
                    $response = $this->actingAs($enrolledMember)->get(route('courses.show', $course));
                    $response->assertStatus(403);
                }

                // Non-enrolled member should get 403
                $response = $this->actingAs($nonEnrolledMember)->get(route('courses.show', $course));
                $response->assertStatus(403);
            }
        });
    }
}
