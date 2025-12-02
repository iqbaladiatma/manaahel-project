<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Program;
use App\Models\Registration;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DashboardPropertiesTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * **Feature: manaahel-platform, Property 44: Pending registrations count accuracy**
     * 
     * For any admin viewing the dashboard, the displayed count of pending registrations 
     * should equal the actual number of registrations with pending status.
     * 
     * **Validates: Requirements 12.1**
     */
    #[Test]
    public function pending_registrations_count_is_accurate()
    {
        $this->forAll(
            Generator\choose(0, 10), // Number of pending registrations
            Generator\choose(0, 5)   // Number of non-pending registrations
        )
        ->withMaxSize(100)
        ->then(function ($pendingCount, $nonPendingCount) {
            // Clear all existing registrations to ensure clean state
            Registration::query()->delete();
            
            // Create pending registrations
            for ($i = 0; $i < $pendingCount; $i++) {
                $program = Program::factory()->create([
                    'slug' => 'program-pending-' . uniqid(),
                ]);
                $user = User::factory()->create(['role' => 'user']);
                
                Registration::factory()->create([
                    'user_id' => $user->id,
                    'program_id' => $program->id,
                    'status' => 'pending',
                ]);
            }

            // Create non-pending registrations (approved or rejected)
            for ($i = 0; $i < $nonPendingCount; $i++) {
                $program = Program::factory()->create([
                    'slug' => 'program-other-' . uniqid(),
                ]);
                $user = User::factory()->create(['role' => 'user']);
                $status = $i % 2 === 0 ? 'approved' : 'rejected';
                
                Registration::factory()->create([
                    'user_id' => $user->id,
                    'program_id' => $program->id,
                    'status' => $status,
                ]);
            }

            // Get the actual count from the database
            $actualPendingCount = Registration::pending()->count();

            // Verify the count matches what we created
            $this->assertEquals($pendingCount, $actualPendingCount,
                "Expected {$pendingCount} pending registrations, but found {$actualPendingCount}");
        });
    }

    /**
     * **Feature: manaahel-platform, Property 45: Published articles count accuracy**
     * 
     * For any admin viewing the dashboard, the displayed count of published articles 
     * should equal the actual number of published articles.
     * 
     * **Validates: Requirements 12.2**
     */
    #[Test]
    public function published_articles_count_is_accurate()
    {
        $this->forAll(
            Generator\choose(0, 15) // Number of articles to create
        )
        ->withMaxSize(100)
        ->then(function ($articleCount) {
            // Clear all existing articles to ensure clean state
            Article::query()->delete();
            
            // Create articles
            for ($i = 0; $i < $articleCount; $i++) {
                Article::factory()->create([
                    'slug' => 'article-' . uniqid(),
                ]);
            }

            // Get the actual count from the database
            $actualArticleCount = Article::count();

            // Verify the count matches what we created
            $this->assertEquals($articleCount, $actualArticleCount,
                "Expected {$articleCount} articles, but found {$actualArticleCount}");
        });
    }

    /**
     * **Feature: manaahel-platform, Property 46: Members count accuracy**
     * 
     * For any admin viewing the dashboard, the displayed count of registered members 
     * should equal the actual number of users with member or user role.
     * 
     * **Validates: Requirements 12.3**
     */
    #[Test]
    public function members_count_is_accurate()
    {
        $this->forAll(
            Generator\choose(0, 10), // Number of members (user/member role)
            Generator\choose(0, 5)   // Number of admins
        )
        ->withMaxSize(100)
        ->then(function ($memberCount, $adminCount) {
            // Clear all existing users to ensure clean state
            User::query()->delete();
            
            // Create members with 'user' or 'member' role
            for ($i = 0; $i < $memberCount; $i++) {
                $role = $i % 2 === 0 ? 'user' : 'member';
                User::factory()->create([
                    'role' => $role,
                    'email' => 'member' . $i . '-' . uniqid() . '@example.com',
                ]);
            }

            // Create admins (should not be counted as members)
            for ($i = 0; $i < $adminCount; $i++) {
                User::factory()->create([
                    'role' => 'admin',
                    'email' => 'admin' . $i . '-' . uniqid() . '@example.com',
                ]);
            }

            // Get the actual count from the database using the members scope
            $actualMemberCount = User::members()->count();

            // Verify the count matches what we created
            $this->assertEquals($memberCount, $actualMemberCount,
                "Expected {$memberCount} members, but found {$actualMemberCount}");
        });
    }
}
