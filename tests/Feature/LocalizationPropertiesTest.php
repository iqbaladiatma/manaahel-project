<?php

namespace Tests\Feature;

use Eris\Generator;
use Eris\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LocalizationPropertiesTest extends TestCase
{
    use TestTrait, RefreshDatabase;

    /**
     * **Feature: manaahel-platform, Property 3: Language persistence across navigation**
     * 
     * For any language selection within a session, navigating to different pages 
     * should maintain the same language preference throughout the session.
     * 
     * **Validates: Requirements 1.4**
     */
    #[Test]
    public function language_persists_across_navigation()
    {
        $this->forAll(
            Generator\elements('id', 'en', 'ar')
        )
        ->withMaxSize(100)
        ->then(function ($locale) {
            // First request: set the locale
            $response1 = $this->get('/?locale=' . $locale);
            $response1->assertStatus(200);
            
            // Verify locale was set in session
            $this->assertEquals($locale, session('locale'));
            
            // Second request: navigate to another page without locale parameter
            $response2 = $this->get('/');
            $response2->assertStatus(200);
            
            // Verify locale persisted in session
            $this->assertEquals($locale, session('locale'));
            
            // Verify application locale is still set correctly
            $this->assertEquals($locale, app()->getLocale());
        });
    }

    /**
     * **Feature: manaahel-platform, Property 2: Non-Arabic languages use LTR layout**
     * 
     * For any language selection that is Indonesian or English, 
     * the layout direction should be set to LTR (Left-to-Right).
     * 
     * **Validates: Requirements 1.3**
     */
    #[Test]
    public function non_arabic_languages_use_ltr_layout()
    {
        $localizationService = app(\App\Services\LocalizationService::class);
        
        $this->forAll(
            Generator\elements('id', 'en', 'ar')
        )
        ->withMaxSize(100)
        ->then(function ($locale) use ($localizationService) {
            $isRTL = $localizationService->isRTL($locale);
            
            if ($locale === 'ar') {
                // Arabic should be RTL
                $this->assertTrue($isRTL, "Arabic locale should use RTL layout");
            } else {
                // Indonesian and English should be LTR (not RTL)
                $this->assertFalse($isRTL, "Locale {$locale} should use LTR layout");
            }
        });
    }
}
