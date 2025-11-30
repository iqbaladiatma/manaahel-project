<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\User;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class AdminPanelPolicyPropertiesTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    /**
     * **Feature: manaahel-platform, Property 34: Admin panel access restriction**
     * 
     * For any user without admin role, attempts to access the admin panel should be rejected.
     * 
     * **Validates: Requirements 9.5**
     */
    #[Test]
    public function admin_panel_access_restricted_to_admins()
    {
        $this->forAll(
            Generator\elements('user', 'member', 'admin')
        )
        ->withMaxSize(100)
        ->then(function ($userRole) {
            // Create a user with the specified role
            $user = User::factory()->create([
                'role' => $userRole,
            ]);

            // Create a request and set the user
            $request = Request::create('/admin', 'GET');
            $request->setUserResolver(function () use ($user) {
                return $user;
            });

            $middleware = new EnsureUserIsAdmin();
            
            $next = function ($req) {
                return response('OK', 200);
            };

            // Assert: only admins should be able to pass through the middleware
            if ($userRole === 'admin') {
                // Admin should be able to pass through
                $response = $middleware->handle($request, $next);
                $this->assertEquals(200, $response->getStatusCode(), "Admin should be able to access admin panel");
            } else {
                // Non-admin should be blocked with 403
                try {
                    $middleware->handle($request, $next);
                    $this->fail("Non-admin user with role '{$userRole}' should be denied access");
                } catch (HttpException $e) {
                    $this->assertEquals(403, $e->getStatusCode(), "Non-admin should get 403 Forbidden");
                }
            }
        });
    }
}
