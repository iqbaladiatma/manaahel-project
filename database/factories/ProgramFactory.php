<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        
        return [
            'name' => [
                'id' => $name,
                'en' => $name,
                'ar' => $name,
            ],
            'slug' => fake()->slug(),
            'type' => fake()->randomElement(['academy', 'competition']),
            'status' => fake()->boolean(80), // 80% chance of being active
            'description' => [
                'id' => fake()->paragraph(),
                'en' => fake()->paragraph(),
                'ar' => fake()->paragraph(),
            ],
            'fees' => fake()->randomFloat(2, 100, 10000),
            'start_date' => fake()->dateTimeBetween('now', '+6 months'),
        ];
    }

    /**
     * Indicate that the program is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => true,
        ]);
    }

    /**
     * Indicate that the program is closed.
     */
    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }
}
