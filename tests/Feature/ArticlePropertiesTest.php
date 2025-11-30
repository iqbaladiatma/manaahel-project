<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ArticlePropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 17: Category filtering accuracy**
     * 
     * For any category filter selection, only articles belonging to that 
     * category should be displayed in the results.
     * 
     * **Validates: Requirements 5.2**
     */
    #[Test]
    public function category_filtering_returns_only_articles_in_that_category()
    {
        $this->forAll(
            Generator\choose(2, 5), // Number of categories to create
            Generator\choose(3, 8)  // Number of articles per category
        )
        ->withMaxSize(100)
        ->then(function ($categoryCount, $articlesPerCategory) {
            // Create categories
            $categories = [];
            for ($i = 0; $i < $categoryCount; $i++) {
                $categories[] = Category::create([
                    'name' => [
                        'en' => "Category {$i}",
                        'id' => "Kategori {$i}",
                        'ar' => "فئة {$i}"
                    ],
                    'slug' => 'category-' . uniqid() . '-' . $i,
                ]);
            }
            
            // Create articles for each category
            $articlesByCategory = [];
            foreach ($categories as $category) {
                $articlesByCategory[$category->id] = [];
                for ($j = 0; $j < $articlesPerCategory; $j++) {
                    $article = Article::create([
                        'title' => [
                            'en' => "Article {$j} for Category {$category->id}",
                            'id' => "Artikel {$j} untuk Kategori {$category->id}",
                            'ar' => "مقالة {$j} للفئة {$category->id}"
                        ],
                        'content' => [
                            'en' => "Content {$j}",
                            'id' => "Konten {$j}",
                            'ar' => "محتوى {$j}"
                        ],
                        'category_id' => $category->id,
                        'is_featured' => false,
                        'slug' => 'article-' . uniqid() . '-' . $j,
                    ]);
                    $articlesByCategory[$category->id][] = $article;
                }
            }
            
            // Test filtering for each category
            foreach ($categories as $category) {
                // Get articles filtered by this category using the scope
                $filteredArticles = Article::byCategory($category->id)->get();
                
                // Verify that all returned articles belong to this category
                foreach ($filteredArticles as $article) {
                    $this->assertEquals(
                        $category->id,
                        $article->category_id,
                        "Article {$article->id} should belong to category {$category->id}"
                    );
                }
                
                // Verify that all articles in this category are returned
                $expectedArticleIds = collect($articlesByCategory[$category->id])->pluck('id')->sort()->values();
                $actualArticleIds = $filteredArticles->pluck('id')->sort()->values();
                
                $this->assertEquals(
                    $expectedArticleIds->toArray(),
                    $actualArticleIds->toArray(),
                    "All articles in category {$category->id} should be returned"
                );
                
                // Verify count matches
                $this->assertCount(
                    $articlesPerCategory,
                    $filteredArticles,
                    "Should return exactly {$articlesPerCategory} articles for category {$category->id}"
                );
            }
        });
    }

    /**
     * **Feature: manaahel-platform, Property 18: Article content in selected language**
     * 
     * For any article and selected language, the full article content should 
     * be displayed in that language.
     * 
     * **Validates: Requirements 5.3**
     */
    #[Test]
    public function article_content_displays_in_selected_language()
    {
        $this->forAll(
            Generator\elements('id', 'en', 'ar')
        )
        ->withMaxSize(100)
        ->then(function ($locale) {
            // Set the application locale
            app()->setLocale($locale);
            
            $uniqueId = uniqid();
            
            // Create a category
            $category = Category::create([
                'name' => [
                    'en' => "Test Category {$uniqueId}",
                    'id' => "Kategori Tes {$uniqueId}",
                    'ar' => "فئة اختبار {$uniqueId}"
                ],
                'slug' => 'category-' . $uniqueId,
            ]);
            
            // Create an article with unique content for each language
            $article = Article::create([
                'title' => [
                    'en' => "English Title {$uniqueId}",
                    'id' => "Judul Indonesia {$uniqueId}",
                    'ar' => "عنوان عربي {$uniqueId}"
                ],
                'content' => [
                    'en' => "English content for article {$uniqueId}",
                    'id' => "Konten Indonesia untuk artikel {$uniqueId}",
                    'ar' => "محتوى عربي للمقالة {$uniqueId}"
                ],
                'category_id' => $category->id,
                'is_featured' => false,
                'slug' => 'article-' . $uniqueId,
            ]);
            
            // Get the article detail page
            $response = $this->get(route('articles.show', $article->slug) . '?locale=' . $locale);
            
            // Verify the response is successful
            $response->assertStatus(200);
            
            // Verify the article title in the selected language appears
            $expectedTitle = $article->getTranslation('title', $locale);
            $response->assertSee($expectedTitle, false);
            
            // Verify the article content in the selected language appears
            $expectedContent = $article->getTranslation('content', $locale);
            $response->assertSee($expectedContent, false);
            
            // Verify the category name in the selected language appears
            $expectedCategoryName = $category->getTranslation('name', $locale);
            $response->assertSee($expectedCategoryName, false);
            
            // Verify that content from other languages does NOT appear
            $otherLocales = array_diff(['id', 'en', 'ar'], [$locale]);
            foreach ($otherLocales as $otherLocale) {
                $otherContent = $article->getTranslation('content', $otherLocale);
                // Only check if the content is different from the selected locale
                if ($otherContent !== $expectedContent) {
                    $response->assertDontSee($otherContent, false);
                }
            }
        });
    }
}
