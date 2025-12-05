<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Program;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class TestRegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::where('email', 'student@test.com')->first();
        
        if (!$student) {
            echo "Student user not found. Run TestUserSeeder first.\n";
            return;
        }

        // Get all programs
        $programs = Program::all();

        foreach ($programs as $program) {
            Registration::create([
                'user_id' => $student->id,
                'program_id' => $program->id,
                'status' => 'approved', // Auto approve for testing
                'payment_proof' => null,
                'notes' => 'Test enrollment - Auto approved',
            ]);

            echo "✓ Enrolled student in: {$program->getTranslation('name', 'id')}\n";
        }

        echo "\nTest registrations created and approved!\n";
        echo "Login as student@test.com to access enrolled programs.\n";
    }
}
