<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'file_path' => 'gallery/' . fake()->uuid() . '.jpg',
            'batch_filter' => fake()->optional(0.5)->numberBetween(2020, 2030),
            'visibility' => fake()->randomElement(['public', 'member_only']),
        ];
    }

    /**
     * Indicate that the gallery is public.
     */
    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'visibility' => 'public',
        ]);
    }

    /**
     * Indicate that the gallery is member-only.
     */
    public function memberOnly(): static
    {
        return $this->state(fn (array $attributes) => [
            'visibility' => 'member_only',
        ]);
    }

    /**
     * Set a specific batch filter.
     */
    public function forBatch(int $batchYear): static
    {
        return $this->state(fn (array $attributes) => [
            'batch_filter' => $batchYear,
        ]);
    }

    /**
     * Remove batch filter.
     */
    public function noBatchFilter(): static
    {
        return $this->state(fn (array $attributes) => [
            'batch_filter' => null,
        ]);
    }
}
