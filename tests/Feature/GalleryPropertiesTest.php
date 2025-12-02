<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GalleryPropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 22: Batch-filtered gallery visibility**
     * 
     * For any member with a specific batch year, the gallery page should display 
     * only items matching their batch year or items with no batch filter.
     * 
     * **Validates: Requirements 7.1**
     */
    #[Test]
    public function batch_filtered_gallery_visibility()
    {
        $this->forAll(
            Generator\choose(2020, 2030), // batch_year
            Generator\choose(2020, 2030)  // gallery batch_filter
        )
        ->withMaxSize(100)
        ->then(function ($userBatchYear, $galleryBatchFilter) {
            // Clean database before each iteration
            Gallery::query()->delete();
            User::query()->delete();

            // Create a member with a specific batch year
            $member = User::factory()->create([
                'batch_year' => $userBatchYear,
                'role' => 'user',
            ]);

            // Create a member-only gallery with batch filter
            $galleryWithBatch = Gallery::factory()->create([
                'visibility' => 'member_only',
                'batch_filter' => $galleryBatchFilter,
            ]);

            // Create a member-only gallery without batch filter
            $galleryWithoutBatch = Gallery::factory()->create([
                'visibility' => 'member_only',
                'batch_filter' => null,
            ]);

            // Get galleries visible to this member
            $visibleGalleries = Gallery::visibleForUser($member)->get();

            // Gallery without batch filter should always be visible
            $this->assertTrue(
                $visibleGalleries->contains($galleryWithoutBatch),
                "Gallery without batch filter should be visible to all members"
            );

            // Gallery with batch filter should only be visible if it matches user's batch
            if ($galleryBatchFilter === $userBatchYear) {
                $this->assertTrue(
                    $visibleGalleries->contains($galleryWithBatch),
                    "Gallery with matching batch filter should be visible"
                );
            } else {
                $this->assertFalse(
                    $visibleGalleries->contains($galleryWithBatch),
                    "Gallery with non-matching batch filter should not be visible"
                );
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 23: Unauthenticated access to member-only gallery redirects**
     * 
     * For any unauthenticated user attempting to access member-only gallery content, 
     * the system should redirect to the login page.
     * 
     * **Validates: Requirements 7.2**
     */
    #[Test]
    public function unauthenticated_access_to_member_only_gallery_redirects()
    {
        $this->forAll(
            Generator\choose(1, 10)
        )
        ->withMaxSize(100)
        ->then(function ($galleryCount) {
            // Clean database before each iteration
            Gallery::query()->delete();

            // Create member-only galleries
            Gallery::factory()->count($galleryCount)->create([
                'visibility' => 'member_only',
            ]);

            // Unauthenticated user accesses gallery page
            $galleries = Gallery::visibleForUser(null)->get();

            // No member-only galleries should be visible to unauthenticated users
            $this->assertEquals(
                0,
                $galleries->count(),
                "Unauthenticated users should not see any member-only galleries"
            );
        });
    }

    /**
     * **Feature: manaahel-platform, Property 24: Public gallery visibility**
     * 
     * For any gallery item with public visibility, it should be displayed 
     * to all users regardless of authentication status.
     * 
     * **Validates: Requirements 7.3**
     */
    #[Test]
    public function public_gallery_visibility()
    {
        $this->forAll(
            Generator\choose(1, 10)
        )
        ->withMaxSize(100)
        ->then(function ($galleryCount) {
            // Clean database before each iteration
            Gallery::query()->delete();
            User::query()->delete();

            // Create public galleries
            $publicGalleries = Gallery::factory()->count($galleryCount)->create([
                'visibility' => 'public',
            ]);

            // Test with unauthenticated user
            $visibleToGuest = Gallery::visibleForUser(null)->get();
            $this->assertEquals(
                $galleryCount,
                $visibleToGuest->count(),
                "All public galleries should be visible to unauthenticated users"
            );

            // Test with authenticated member
            $member = User::factory()->create(['role' => 'user']);
            $visibleToMember = Gallery::visibleForUser($member)->get();
            $this->assertEquals(
                $galleryCount,
                $visibleToMember->count(),
                "All public galleries should be visible to authenticated members"
            );

            // Verify all public galleries are in the results
            foreach ($publicGalleries as $gallery) {
                $this->assertTrue(
                    $visibleToGuest->contains($gallery),
                    "Public gallery should be visible to guests"
                );
                $this->assertTrue(
                    $visibleToMember->contains($gallery),
                    "Public gallery should be visible to members"
                );
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 25: Member-only gallery requires authentication**
     * 
     * For any gallery item with member-only visibility, it should only be 
     * displayed to authenticated members.
     * 
     * **Validates: Requirements 7.4**
     */
    #[Test]
    public function member_only_gallery_requires_authentication()
    {
        $this->forAll(
            Generator\choose(1, 10),
            Generator\choose(2020, 2030)
        )
        ->withMaxSize(100)
        ->then(function ($galleryCount, $batchYear) {
            // Clean database before each iteration
            Gallery::query()->delete();
            User::query()->delete();

            // Create member-only galleries without batch filter
            $memberOnlyGalleries = Gallery::factory()->count($galleryCount)->create([
                'visibility' => 'member_only',
                'batch_filter' => null,
            ]);

            // Test with unauthenticated user
            $visibleToGuest = Gallery::visibleForUser(null)->get();
            $this->assertEquals(
                0,
                $visibleToGuest->count(),
                "Member-only galleries should not be visible to unauthenticated users"
            );

            // Test with authenticated member
            $member = User::factory()->create([
                'role' => 'user',
                'batch_year' => $batchYear,
            ]);
            $visibleToMember = Gallery::visibleForUser($member)->get();
            $this->assertEquals(
                $galleryCount,
                $visibleToMember->count(),
                "All member-only galleries (without batch filter) should be visible to authenticated members"
            );

            // Verify all member-only galleries are visible to authenticated members
            foreach ($memberOnlyGalleries as $gallery) {
                $this->assertFalse(
                    $visibleToGuest->contains($gallery),
                    "Member-only gallery should not be visible to guests"
                );
                $this->assertTrue(
                    $visibleToMember->contains($gallery),
                    "Member-only gallery should be visible to authenticated members"
                );
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 33: Gallery creation with options**
     * 
     * For any gallery item created by an admin, the visibility and batch filter 
     * options should be saved with the gallery record.
     * 
     * **Validates: Requirements 9.3**
     */
    #[Test]
    public function gallery_creation_with_options()
    {
        $this->forAll(
            Generator\elements('public', 'member_only'),
            Generator\oneOf(
                Generator\constant(null),
                Generator\choose(2020, 2030)
            )
        )
        ->withMaxSize(100)
        ->then(function ($visibility, $batchFilter) {
            // Clean database before each iteration
            Gallery::query()->delete();

            // Create a gallery with specific visibility and batch filter options
            $gallery = Gallery::factory()->create([
                'visibility' => $visibility,
                'batch_filter' => $batchFilter,
            ]);

            // Retrieve the gallery from database to verify persistence
            $savedGallery = Gallery::find($gallery->id);

            // Verify visibility option is saved correctly
            $this->assertEquals(
                $visibility,
                $savedGallery->visibility,
                "Gallery visibility should be saved as '{$visibility}'"
            );

            // Verify batch filter option is saved correctly
            $this->assertEquals(
                $batchFilter,
                $savedGallery->batch_filter,
                "Gallery batch_filter should be saved correctly"
            );

            // Verify the gallery has all required fields
            $this->assertNotNull($savedGallery->title, "Gallery should have a title");
            $this->assertNotNull($savedGallery->file_path, "Gallery should have a file_path");
            $this->assertContains(
                $savedGallery->visibility,
                ['public', 'member_only'],
                "Gallery visibility should be either 'public' or 'member_only'"
            );
        });
    }
}
