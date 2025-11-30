<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        
        return [
            'title' => [
                'id' => $title,
                'en' => $title,
                'ar' => $title,
            ],
            'content' => [
                'id' => fake()->paragraphs(3, true),
                'en' => fake()->paragraphs(3, true),
                'ar' => fake()->paragraphs(3, true),
            ],
            'category_id' => Category::factory(),
            'is_featured' => fake()->boolean(20), // 20% chance of being featured
            'slug' => fake()->slug(),
        ];
    }

    /**
     * Indicate that the article is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
