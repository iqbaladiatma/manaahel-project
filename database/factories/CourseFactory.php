<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => [
                'id' => $this->faker->sentence(),
                'en' => $this->faker->sentence(),
                'ar' => 'عنوان الدورة ' . $this->faker->numberBetween(1, 100)
            ],
            'content' => [
                'id' => $this->faker->paragraph(),
                'en' => $this->faker->paragraph(),
                'ar' => 'محتوى الدورة ' . $this->faker->paragraph()
            ],
            'program_id' => Program::factory(),
            'video_url' => $this->faker->url(),
        ];
    }
}
