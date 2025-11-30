<?php

namespace App\Services;

class LocalizationService
{
    /**
     * Set the application locale.
     *
     * @param string $locale
     * @return void
     */
    public function setLocale(string $locale): void
    {
        $supportedLocales = $this->getAvailableLocales();
        
        if (in_array($locale, $supportedLocales)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }
    }
    
    /**
     * Get all available locales.
     *
     * @return array
     */
    public function getAvailableLocales(): array
    {
        return ['id', 'en', 'ar'];
    }
    
    /**
     * Check if the given locale uses RTL layout.
     *
     * @param string $locale
     * @return bool
     */
    public function isRTL(string $locale): bool
    {
        return $locale === 'ar';
    }
}
