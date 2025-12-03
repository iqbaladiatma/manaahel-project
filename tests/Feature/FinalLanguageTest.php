<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Program;
use App\Services\LocalizationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FinalLanguageTest extends TestCase
{
    use RefreshDatabase;

    protected LocalizationService $localizationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->localizationService = app(LocalizationService::class);
    }

    /**
     * Test that all three languages (Indonesian, English, Arabic) display correctly
     * Requirements: 1.1, 1.2, 1.3
     */
    #[Test]
    public function all_three_languages_display_correctly()
    {
        // Create test data with translations
        $category = Category::create([
            'name' => [
                'id' => 'Kategori Umum',
                'en' => 'General Category',
                'ar' => 'فئة عامة'
            ],
            'slug' => 'general'
        ]);

        $article = Article::create([
            'title' => [
                'id' => 'Judul Artikel',
                'en' => 'Article Title',
                'ar' => 'عنوان المقالة'
            ],
            'content' => [
                'id' => 'Konten artikel dalam bahasa Indonesia',
                'en' => 'Article content in English',
                'ar' => 'محتوى المقال بالعربية'
            ],
            'category_id' => $category->id,
            'slug' => 'test-article',
            'is_featured' => false
        ]);

        $program = Program::create([
            'name' => [
                'id' => 'Program Akademi',
                'en' => 'Academy Program',
                'ar' => 'برنامج الأكاديمية'
            ],
            'description' => [
                'id' => 'Deskripsi program',
                'en' => 'Program description',
                'ar' => 'وصف البرنامج'
            ],
            'slug' => 'academy-program',
            'type' => 'academy',
            'status' => true,
            'fees' => 1000000,
            'start_date' => now()->addMonth()
        ]);

        $languages = ['id', 'en', 'ar'];

        foreach ($languages as $locale) {
            // Set locale
            $response = $this->get('/?locale=' . $locale);
            $response->assertStatus(200);

            // Verify locale is set
            $this->assertEquals($locale, app()->getLocale());
            $this->assertEquals($locale, session('locale'));

            // Test article display in selected language
            $response = $this->get('/articles/' . $article->slug . '?locale=' . $locale);
            $response->assertStatus(200);
            $response->assertSee($article->getTranslation('title', $locale));
            $response->assertSee($article->getTranslation('content', $locale));

            // Test program display in selected language
            $response = $this->get('/programs/' . $program->slug . '?locale=' . $locale);
            $response->assertStatus(200);
            $response->assertSee($program->getTranslation('name', $locale));
            $response->assertSee($program->getTranslation('description', $locale));
        }
    }

    /**
     * Test RTL layout for Arabic
     * Requirements: 1.2, 1.3
     */
    #[Test]
    public function arabic_uses_rtl_layout()
    {
        $response = $this->get('/?locale=ar');
        $response->assertStatus(200);

        // Verify Arabic is RTL
        $this->assertTrue($this->localizationService->isRTL('ar'));

        // Check that the HTML has RTL direction
        $response->assertSee('dir="rtl"', false);
        $this->assertEquals('ar', app()->getLocale());
    }

    /**
     * Test LTR layout for Indonesian and English
     * Requirements: 1.2, 1.3
     */
    #[Test]
    public function indonesian_and_english_use_ltr_layout()
    {
        $ltrLanguages = ['id', 'en'];

        foreach ($ltrLanguages as $locale) {
            $response = $this->get('/?locale=' . $locale);
            $response->assertStatus(200);

            // Verify language is LTR (not RTL)
            $this->assertFalse($this->localizationService->isRTL($locale));

            // Check that the HTML has LTR direction
            $response->assertSee('dir="ltr"', false);
            $this->assertEquals($locale, app()->getLocale());
        }
    }

    /**
     * Test language switcher functionality
     * Requirements: 1.1
     */
    #[Test]
    public function language_switcher_changes_language()
    {
        $languages = ['id', 'en', 'ar'];

        foreach ($languages as $locale) {
            $response = $this->get('/?locale=' . $locale);
            $response->assertStatus(200);

            // Verify the locale was set
            $this->assertEquals($locale, session('locale'));
            $this->assertEquals($locale, app()->getLocale());

            // Verify available locales
            $availableLocales = $this->localizationService->getAvailableLocales();
            $this->assertContains($locale, $availableLocales);
            $this->assertCount(3, $availableLocales);
        }
    }

    /**
     * Test that translatable content is properly stored and retrieved
     * Requirements: 1.1
     */
    #[Test]
    public function translatable_content_stored_and_retrieved_correctly()
    {
        $category = Category::create([
            'name' => [
                'id' => 'Prestasi',
                'en' => 'Achievement',
                'ar' => 'إنجاز'
            ],
            'slug' => 'achievement'
        ]);

        // Verify all translations are stored
        $this->assertEquals('Prestasi', $category->getTranslation('name', 'id'));
        $this->assertEquals('Achievement', $category->getTranslation('name', 'en'));
        $this->assertEquals('إنجاز', $category->getTranslation('name', 'ar'));

        // Verify fallback to default language if translation missing
        $category->setTranslation('name', 'ar', null);
        $category->save();
        
        // Should fallback to default locale (id)
        app()->setLocale('ar');
        $this->assertNotNull($category->name);
    }
}
