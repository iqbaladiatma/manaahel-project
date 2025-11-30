<?php

namespace Tests\Feature;

use App\Models\Program;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProgramPropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 4: Active programs visibility**
     * 
     * For any program with active status, it should appear in the programs 
     * list displayed to users.
     * 
     * **Validates: Requirements 2.1**
     */
    #[Test]
    public function active_programs_appear_in_list()
    {
        $this->forAll(
            Generator\choose(1, 5), // Number of programs to create
            Generator\bool() // Status for the programs
        )
        ->withMaxSize(100)
        ->then(function ($count, $status) {
            // Create programs with the generated data
            $createdPrograms = [];
            for ($i = 0; $i < $count; $i++) {
                $createdPrograms[] = Program::create([
                    'name' => ['en' => "Test Program {$i}", 'id' => "Program Tes {$i}", 'ar' => "برنامج اختبار {$i}"],
                    'slug' => 'program-' . uniqid() . '-' . $i,
                    'type' => $i % 2 === 0 ? 'academy' : 'competition',
                    'status' => $status,
                    'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                    'fees' => 1000000 + ($i * 100000),
                    'start_date' => now()->addDays(30 + $i)->format('Y-m-d'),
                ]);
            }
            
            // Get active programs using the scope
            $activePrograms = Program::active()->get();
            
            // Verify that all active programs are in the result
            foreach ($createdPrograms as $program) {
                if ($program->status === true) {
                    $this->assertTrue(
                        $activePrograms->contains('id', $program->id),
                        "Active program {$program->id} should appear in the active programs list"
                    );
                } else {
                    $this->assertFalse(
                        $activePrograms->contains('id', $program->id),
                        "Inactive program {$program->id} should not appear in the active programs list"
                    );
                }
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 5: Program details in selected language**
     * 
     * For any program and selected language, the program detail page should 
     * display all fields (description, fees, dates) in that language.
     * 
     * **Validates: Requirements 2.2**
     */
    #[Test]
    public function program_details_display_in_selected_language()
    {
        $this->forAll(
            Generator\elements('id', 'en', 'ar')
        )
        ->withMaxSize(100)
        ->then(function ($locale) {
            // Set the application locale
            app()->setLocale($locale);
            
            $nameNum = rand(100, 999);
            
            // Create the program with unique slug
            $program = Program::create([
                'name' => [
                    'en' => "Program {$nameNum}",
                    'id' => "Program {$nameNum}",
                    'ar' => "برنامج {$nameNum}"
                ],
                'slug' => 'program-' . uniqid(),
                'type' => 'academy',
                'status' => true,
                'description' => [
                    'en' => "Description {$nameNum}",
                    'id' => "Deskripsi {$nameNum}",
                    'ar' => "وصف {$nameNum}"
                ],
                'fees' => 1000000,
                'start_date' => now()->addDays(60)->format('Y-m-d')
            ]);
            
            // Get the program details page with locale parameter
            $response = $this->get(route('programs.show', $program->slug) . '?locale=' . $locale);
            
            // Verify the response is successful
            $response->assertStatus(200);
            
            // Verify the program name in the selected language appears in the response
            $expectedName = $program->getTranslation('name', $locale);
            $response->assertSee($expectedName, false);
            
            // Verify the program description in the selected language appears
            $expectedDescription = $program->getTranslation('description', $locale);
            $response->assertSee($expectedDescription, false);
            
            // Verify fees are displayed
            $response->assertSee(number_format($program->fees, 0, ',', '.'), false);
            
            // Verify start date is displayed
            $response->assertSee($program->start_date->format('d F Y'), false);
        });
    }

    /**
     * **Feature: manaahel-platform, Property 6: Closed program indication**
     * 
     * For any program with closed status, the system should display an 
     * indication that registration is not available.
     * 
     * **Validates: Requirements 2.3**
     */
    #[Test]
    public function closed_programs_show_registration_closed_indicator()
    {
        $this->forAll(
            Generator\elements('academy', 'competition'),
            Generator\choose(100000, 10000000),
            Generator\choose(30, 365)
        )
        ->withMaxSize(10) // Reduced for faster execution with HTTP requests
        ->then(function ($type, $fees, $days) {
            // Create a closed program with unique slug
            $program = Program::create([
                'name' => ['en' => 'Test Program', 'id' => 'Program Tes', 'ar' => 'برنامج اختبار'],
                'slug' => 'program-' . uniqid(),
                'type' => $type,
                'status' => false, // Always closed
                'description' => ['en' => 'Description', 'id' => 'Deskripsi', 'ar' => 'وصف'],
                'fees' => $fees,
                'start_date' => now()->addDays($days)->format('Y-m-d')
            ]);
            
            // Visit the program detail page
            $response = $this->get(route('programs.show', $program->slug));
            
            // Verify the response is successful
            $response->assertStatus(200);
            
            // Verify "Registration Closed" indicator appears
            $response->assertSee('Registration Closed', false);
            
            // Verify the registration form/button is not shown (or shows closed message)
            $response->assertSee('Registration for this program is currently closed', false);
            
            // Visit the programs index page
            $indexResponse = $this->get(route('programs.index'));
            
            // Since the program is closed (status = false), it should NOT appear in the active programs list
            // The index only shows active programs
            $indexResponse->assertDontSee($program->getTranslation('name', 'en'), false);
        });
    }
}
